<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Booking;
use App\Models\TattooStyle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Quản lý yêu cầu đặt lịch (bảng bookings).
 *
 * Khách chỉ gửi lên tên, liên hệ, ngày mong muốn và ý tưởng hình xăm. Phần còn
 * lại là việc của admin sau khi gọi điện xác nhận: gán artist, chốt phong cách,
 * vị trí xăm, kích thước, giờ hẹn và ghi chú nội bộ.
 *
 * handled_by tự ghi người đang đăng nhập mỗi lần lưu — để biết ai chạm vào
 * đơn gần nhất.
 */
class BookingController extends Controller
{
    public static $statuses = [
        'new'       => 'Mới đặt',
        'contacted' => 'Đã liên hệ',
        'confirmed' => 'Đã xác nhận',
        'done'      => 'Hoàn thành',
        'cancelled' => 'Đã hủy',
    ];

    /** Màu nhãn trạng thái trên danh sách. */
    public static $statusLabels = [
        'new'       => 'label-warning',
        'contacted' => 'label-info',
        'confirmed' => 'label-primary',
        'done'      => 'label-success',
        'cancelled' => 'label-default',
    ];

    private $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function index(Request $request)
    {
        $uri = 'booking';
        $requestData = $request->all();

        $query = $this->booking->with(['artist', 'tattooStyle'])
            ->orderBy('created_at', 'desc');

        if ($code = $request->input('code')) {
            $query->where('code', 'like', '%'.$code.'%');
        }

        if ($name = $request->input('full_name')) {
            $query->where('full_name', 'like', '%'.$name.'%');
        }

        if ($email = $request->input('email')) {
            $query->where('email', 'like', '%'.$email.'%');
        }

        if ($phone = $request->input('phone')) {
            $query->where('phone', 'like', '%'.$phone.'%');
        }

        if (($status = $request->input('status')) !== null && $status !== '') {
            $query->where('status', $status);
        }

        if (($artistId = $request->input('artist_id')) !== null && $artistId !== '') {
            $query->where('artist_id', (int) $artistId);
        }

        if ($from = $request->input('date_from')) {
            $query->whereDate('preferred_date', '>=', $from);
        }

        if ($to = $request->input('date_to')) {
            $query->whereDate('preferred_date', '<=', $to);
        }

        $booking = $query->paginate(20);

        $statuses    = static::$statuses;
        $statusLabel = static::$statusLabels;
        $artists     = Artist::withTrashed()->orderBy('sort_order')->get();

        return view('admin.booking.index', compact(
            'uri', 'booking', 'requestData', 'statuses', 'statusLabel', 'artists'
        ));
    }

    public function edit(Request $request)
    {
        $uri     = 'booking';
        $booking = $this->booking->with(['artist', 'tattooStyle', 'handler'])->findOrFail($request->id);

        return view('admin.booking.edit', [
            'uri'      => $uri,
            'booking'  => $booking,
            'statuses' => static::$statuses,
            'artists'  => Artist::withTrashed()->orderBy('sort_order')->get(),
            'styles'   => TattooStyle::withTrashed()->orderBy('sort_order')->get(),
        ]);
    }

    public function update(Request $request)
    {
        $booking = $this->booking->findOrFail($request->id);

        $data = $request->validate([
            'id'              => ['required'],
            'full_name'       => ['required', 'string', 'max:120'],
            'phone'           => ['required', 'string', 'max:40'],
            'email'           => ['required', 'email', 'max:190'],
            'preferred_date'  => ['nullable', 'date'],
            'preferred_time'  => ['nullable', 'date_format:H:i'],
            'artist_id'       => ['nullable', 'integer'],
            'tattoo_style_id' => ['nullable', 'integer'],
            'placement'       => ['nullable', 'string', 'max:120'],
            'size_cm'         => ['nullable', 'string', 'max:40'],
            'status'          => ['required', Rule::in(array_keys(static::$statuses))],
            'admin_note'      => ['nullable', 'string', 'max:5000'],
        ], [], [
            'full_name'      => 'họ tên',
            'phone'          => 'số điện thoại',
            'preferred_date' => 'ngày hẹn',
            'preferred_time' => 'giờ hẹn',
            'status'         => 'trạng thái',
        ]);

        unset($data['id']);

        $data['artist_id']       = $data['artist_id'] ?: null;
        $data['tattoo_style_id'] = $data['tattoo_style_id'] ?: null;
        $data['preferred_date']  = $data['preferred_date'] ?: null;
        $data['preferred_time']  = $data['preferred_time'] ?: null;

        // ghi lại ai vừa xử lý đơn
        $data['handled_by'] = auth()->id();

        if ($booking->update($data)) {
            return redirect()->route('admin.booking')->with('success', 'Cập nhật đơn '.$booking->code.' thành công');
        }

        return redirect()->back()->with('error', 'Cập nhật không thành công');
    }
}
