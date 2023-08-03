<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Booking;
use App\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventBookingController extends Controller
{
    public function eventBooking(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'name' => 'required',
                'phone' => 'required',
                'date' => 'required',
            ]);
            // $date = $request->all();

            $have_booking = Booking::where(['event_id'=>$request->event_id])->where(['booking_date'=>$request->date])->where(['booking_time'=>$request->time])->where(['status'=>1])->count();
            if ($have_booking>0) {
                return redirect()->back()->with('event_flash_success','Already booked ....');
            }
            $booking = new Booking;
            $booking->booked_by_name = $request->name;
            $booking->phone = $request->phone;
            $booking->booking_date = $request->date;
            $booking->booking_time = $request->time;
            $booking->min_guest = $request->min_guest;
            $booking->max_guest = $request->max_guest;
            $booking->email = $request->email;
            $booking->note = $request->note;
            $booking->event_id = $request->event_id;

            $booking->save();
            return redirect()->back()->with('event_flash_success','Your booking will be confirmed via phone call...');
        }      
        
    }
}
