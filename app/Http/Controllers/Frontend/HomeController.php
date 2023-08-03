<?php

namespace App\Http\Controllers\Frontend;
use App\Category;
use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class HomeController extends Controller
{
	public function index()
    {
        return view('index');
    }
}
