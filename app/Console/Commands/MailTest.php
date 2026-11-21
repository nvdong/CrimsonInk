<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

/**
 * Kiem tra cau hinh gui mail ngay tren server production.
 *
 * Dung de phan biet ba loai loi hay gap khi doi sang Mailgun:
 *   - 401 Unauthorized  -> sai API key, hoac domain tao o region EU nhung
 *                          MAILGUN_ENDPOINT van de api.mailgun.net
 *   - 404 Not Found     -> MAILGUN_DOMAIN khong dung ten domain trong Mailgun
 *   - 403 Forbidden     -> domain chua verify xong DNS
 */
class MailTest extends Command
{
    protected $signature = 'ci:mail-test {email? : Dia chi nhan thu thu, mac dinh lay CONTACT_MAIL_TO}';

    protected $description = 'Gui mot email thu de kiem tra cau hinh mail tren server';

    public function handle(): int
    {
        $to = $this->argument('email') ?: config('mail.contact_to');

        if (! $to) {
            $this->error('Chua co dia chi nhan. Truyen vao: php artisan ci:mail-test you@example.com');

            return 1;
        }

        $mailer = config('mail.default');

        $this->line('Mailer   : '.$mailer);

        if ($mailer === 'mailgun') {
            /* Khong in secret ra terminal, chi in do dai de biet da nap duoc
               bien moi truong hay chua. */
            $secret = (string) config('services.mailgun.secret');

            $this->line('Domain   : '.(config('services.mailgun.domain') ?: '(TRONG)'));
            $this->line('Endpoint : '.config('services.mailgun.endpoint'));
            /* In duoi key chu khong in key. Mailgun hien phan duoi nay o cot
               "Key ID" trong trang API keys, nen doi chieu duoc ngay la .env
               dang dung key nao ma khong lo lo bi mat. */
            $this->line('API key  : '.($secret === ''
                ? '(TRONG)'
                : strlen($secret).' ky tu, duoi key = "'.substr($secret, -17).'"'));

            /* Key Mailgun doi moi co dang <32 hex>-<8 hex>-<8 hex>. Dung do dai
               thoi khong du: neu nguoi dung copy nham ban key bi che (masked)
               tren danh sach thi do dai van 50 va duoi key van khop, chi co
               doan dau la khong phai hex. Kiem tra ca chuoi moi phat hien ra. */
            if ($secret !== '') {
                if (preg_match('/^[0-9a-f]{32}-[0-9a-f]{8}-[0-9a-f]{8}$/i', $secret)) {
                    $this->line('Dinh dang: OK (32 hex - 8 hex - 8 hex)');
                } else {
                    $this->error('Dinh dang: SAI — khong khop <32 hex>-<8 hex>-<8 hex>');

                    $dau = substr($secret, 0, 32);
                    $this->line('           32 ky tu dau co '
                        .strlen(preg_replace('/[0-9a-f]/i', '', $dau))
                        .' ky tu KHONG phai hex (dung ra phai la 0).');
                    $this->line('           Nhieu kha nang ban copy nham ban key bi che tren');
                    $this->line('           danh sach. Key that chi hien dung mot lan luc Create key.');
                }
            }
        } elseif ($mailer === 'smtp') {
            $this->line('Host     : '.config('mail.mailers.smtp.host').':'.config('mail.mailers.smtp.port'));
            $this->line('Timeout  : '.config('mail.mailers.smtp.timeout').'s');
        }

        $this->line('From     : '.config('mail.from.address'));
        $this->line('To       : '.$to);
        $this->newLine();

        try {
            Mail::raw(
                "Day la email thu tu Crimson Ink.\n\nMailer: ".$mailer."\nThoi gian: ".now()->toDateTimeString(),
                static function ($mail) use ($to) {
                    $mail->to($to)->subject('Crimson Ink — test mail');
                }
            );
        } catch (\Throwable $e) {
            $this->error('THAT BAI: '.$e->getMessage());

            /* Laravel boc moi loi Guzzle vao mot Swift_TransportException chung
               la "Request to Mailgun API failed.", nen ma HTTP va noi dung
               Mailgun tra ve nam o exception ben trong. Phai lan xuong tan cung
               moi doc duoc nguyen nhan that. */
            $goc = $e;
            while ($goc->getPrevious() !== null) {
                $goc = $goc->getPrevious();
            }

            if ($goc instanceof \GuzzleHttp\Exception\RequestException && $goc->hasResponse()) {
                $res = $goc->getResponse();
                $this->newLine();
                $this->error('HTTP '.$res->getStatusCode().' '.$res->getReasonPhrase());
                $this->line('Mailgun tra ve: '.substr((string) $res->getBody(), 0, 1000));
            } elseif ($goc !== $e) {
                $this->newLine();
                $this->error(get_class($goc));
                $this->line($goc->getMessage());
            }

            if ($mailer === 'mailgun') {
                $this->doRegion();
            }

            return 1;
        }

        $this->info('OK — da day mail di. Kiem tra hop thu '.$to.' (ca thu muc Spam).');

        return 0;
    }

    /**
     * Thu chinh API key voi ca hai region cua Mailgun.
     *
     * Mailgun tach hoan toan US va EU: key tao o vung nay goi sang vung kia se
     * tra ve 401 "Forbidden" y het nhu khi key sai. Cach duy nhat phan biet la
     * goi thu ca hai endpoint — vung nao tra 200 thi do la vung cua key.
     */
    private function doRegion(): void
    {
        $secret = (string) config('services.mailgun.secret');

        $this->newLine();
        $this->line('--- Do xem key thuoc region nao (goi GET /v4/domains) ---');

        if ($secret === '') {
            $this->error('MAILGUN_SECRET trong. Chay: php artisan config:clear');

            return;
        }

        $client = new \GuzzleHttp\Client([
            'http_errors'     => false,
            'timeout'         => 20,
            'connect_timeout' => 10,
        ]);

        foreach (['api.mailgun.net' => 'US', 'api.eu.mailgun.net' => 'EU'] as $endpoint => $vung) {
            try {
                $res = $client->get('https://'.$endpoint.'/v4/domains', [
                    'auth'  => ['api', $secret],
                    'query' => ['limit' => 100],
                ]);
            } catch (\Throwable $e) {
                $this->line(sprintf('  %-19s %-2s  loi mang: %s', $endpoint, $vung, $e->getMessage()));
                continue;
            }

            $ma   = $res->getStatusCode();
            $than = trim((string) $res->getBody());

            if ($ma !== 200) {
                $this->line(sprintf('  %-19s %-2s  HTTP %d  %s', $endpoint, $vung, $ma, substr($than, 0, 100)));

                continue;
            }

            $ten = [];
            foreach ((array) (json_decode($than, true)['items'] ?? []) as $item) {
                $ten[] = ($item['name'] ?? '?').(($item['state'] ?? '') !== '' ? ' ['.$item['state'].']' : '');
            }

            $this->info(sprintf(
                '  %-19s %-2s  HTTP 200  <= KEY THUOC VUNG NAY',
                $endpoint,
                $vung
            ));
            $this->line('     Domain trong tai khoan: '.($ten ? implode(', ', $ten) : '(chua co domain nao)'));
        }
    }
}
