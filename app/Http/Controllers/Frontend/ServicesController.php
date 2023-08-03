<?php

namespace App\Http\Controllers\Frontend;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Category;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{   
	public function showServices()
    {
        return view('services');
    }
}
