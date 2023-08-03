<?php

namespace App\Http\Controllers\Backend\User;
use DB;
use Auth;
use Validator;
use App\User;
use App\Events;
use App\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bookings = DB::table('events')
                ->join('bookings', 'events.id', '=', 'bookings.event_id')
                ->where(['events.posted_by_id'=>Auth::user()->id])
                ->where(['bookings.status'=>1])
                ->orderBy('bookings.id', 'DESC')
                ->paginate(3);
        return view('user.dashboard')->with(compact('bookings'));
    }
}
