<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    private $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function index(Request $request) {
        $uri = 'Booking';
        $requestData = $request->all();

        $booking = $this->booking->paginate(20);

        return view('admin.booking.index', compact('uri','booking','requestData'));
    }

    public function edit(Request $request) {
        $booking = $this->booking->findOrFail($request->id);
        return view('admin.booking.edit', compact('booking'));
    }

     public function update(Request $request) {
        $request->validate([
            'id'=>'required',
            'preferred_date'=>'required',
        ]);

        $booking = $this->booking->findOrFail($request->id);

        $booking->preferred_date = $request->preferred_date;
        $booking->status = $request->status;

        if($booking->save()) {
            return redirect()->route('admin.booking')->with('success', 'Cập nhật thành công');
        }

        return redirect()->back()->with('error', 'Cập nhật không thành công');


    }
    
}
