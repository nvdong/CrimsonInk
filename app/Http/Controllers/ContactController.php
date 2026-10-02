<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Booking;
use App\Support\Text;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;


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
            'artist'         => ['nullable', 'string'],
            'message'        => ['required', 'string', 'max:5000'],
        ], Text::group('booking.form.messages'), Text::group('booking.form.attributes'));

        $artistName = $data['artist']
            ? (optional($artists->firstWhere('id', $data['artist']))->name ?: $data['artist'])
            : null;

        $booking = new Booking();
        $booking->code = Booking::nextCode();
        $booking->full_name = $data['full_name'];
        $booking->phone = $data['phone'];
        $booking->email = $data['email'];
        $booking->preferred_date = $data['preferred_date'];
        $booking->artist_id = $data['artist'];
        $booking->status = Booking::STAT_NEW;
        $booking->message= $data['message'];
        $booking->save();

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

            try {
                Mail::raw($body, function ($mail) use ($to, $data) {
                    $mail->to($to)
                        ->replyTo($data['email'])
                        ->subject('New booking request — '.$data['full_name']);
                });
            } catch (\Throwable $e) {
                Log::error('Không gửi được email báo đơn đặt lịch '.$booking->code.': '.$e->getMessage());
            }
        }

        return redirect()
            ->to(route('page.contact-us').'#booking')
            ->with('contact_success', Text::get('booking.form.success'));
    }
}
