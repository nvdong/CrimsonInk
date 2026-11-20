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
            $this->line('API key  : '.($secret === '' ? '(TRONG)' : 'da nap, '.strlen($secret).' ky tu'));
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

            return 1;
        }

        $this->info('OK — da day mail di. Kiem tra hop thu '.$to.' (ca thu muc Spam).');

        return 0;
    }
}
