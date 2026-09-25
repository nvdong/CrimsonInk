<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

/**
 * Nhận yêu cầu đặt lịch xăm từ trang /contact-us.
 *
 * Mặc định chỉ ghi log (storage/logs). Đặt CONTACT_MAIL_TO trong .env
 * để đồng thời gửi email mỗi khi có người gửi form.
 */
class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $artists = Artist::active()->ordered()->get();

        $data = $request->validate([
            'full_name'      => ['required', 'string', 'max:120'],
            'phone'          => ['required', 'string', 'max:40'],
            'email'          => ['required', 'email', 'max:190'],
            'preferred_date' => ['nullable', 'date', 'after_or_equal:today'],
            'artist'         => ['nullable', 'string', Rule::in($artists->pluck('slug')->all())],
            'message'        => ['required', 'string', 'max:5000'],
        ], [], [
            'full_name'      => 'full name',
            'phone'          => 'phone number',
            'preferred_date' => 'preferred date',
            'artist'         => 'tattoo artist',
            'message'        => 'tattoo idea',
        ]);

        // đổi slug artist sang tên cho dễ đọc trong log / email
        $artistName = $data['artist']
            ? (optional($artists->firstWhere('slug', $data['artist']))->name ?: $data['artist'])
            : null;

        Log::info('Booking request', $data + [
            'artist_name' => $artistName,
            'ip'          => $request->ip(),
        ]);

        if ($to = config('mail.contact_to')) {
            $body = implode("\n", array_filter([
                'Name:    '.$data['full_name'],
                'Phone:   '.$data['phone'],
                'Email:   '.$data['email'],
                $data['preferred_date'] ? 'Date:    '.$data['preferred_date'] : null,
                $artistName ? 'Artist:  '.$artistName : null,
                '',
                $data['message'],
            ], static fn ($line) => $line !== null));

            Mail::raw($body, function ($mail) use ($to, $data) {
                $mail->to($to)
                    ->replyTo($data['email'])
                    ->subject('New booking request — '.$data['full_name']);
            });
        }

        return redirect()
            ->to(route('page.contact-us').'#booking')
            ->with('contact_success', 'Thank you! We have received your booking request and will get back to you shortly.');
    }
}
