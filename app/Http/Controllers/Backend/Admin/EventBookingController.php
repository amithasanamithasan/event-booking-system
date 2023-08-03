<?php

namespace App\Http\Controllers\Backend\Admin;

use Auth;
use Validator;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use App\Category;
use App\Booking;
use App\Events;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class EventBookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function showUnapprovedBookingList($id=null)
    {
        $bookings = Booking::get();

        if (!empty($id)) {
            $book = Booking::find($id);
            $book->status = 1;
            $book->save();
            return redirect()->back()->with('booking_flash_success','Successfully approved',compact('bookings'));
        }
        return view('admin.booking_list')->with(compact('bookings'));
    }
    public function deleteBooking($id=null)
    {
        if (!empty($id)) {
            Booking::find($id)->delete();
            return redirect()->back()->with('booking_flash_success','Book successfully deleted');
        }
        
    }
    public function showBookingsList($id=null)
    {
        $bookings = Booking::get();

        if (!empty($id)) {
            $book = Booking::find($id);
            $book->status = 1;

            $book->save();
            return redirect()->back()->with('booking_flash_success','Successfully approved',compact('bookings'));
        }
        return view('admin.booking_list')->with(compact('bookings'));
    }
    public function showEventList()
    {
        $events = Events::get();
        return view('admin.event_list')->with(compact('events'));
    }
    public function deleteEvent($id=null)
    {
        if (!empty($id)) {
            $data = Events::FindOrFail($id);
            if (!empty($data->image)) {
                unlink('images/events/'.$data->image);
            }
            Events::find($id)->delete();
            return redirect()->back()->with('delete_event_flash_success','event successfully deleted');
        } 
    }
}
