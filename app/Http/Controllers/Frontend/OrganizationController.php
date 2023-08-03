<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Events;
use App\Review;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrganizationController extends Controller
{
    public function organizationList($id=null)
    {
        $org_type = Category::where(['id'=>$id])->pluck('name')[0];
    	$events = Events::where(['category_id'=>$id])->orderBy('id', 'desc')->paginate(4);
        return view('organization')->with(compact('events','org_type'));
    }
    public function showEventDetails($id)
    {
        $event = Events::find($id);
        return view('event_details')->with(compact('event'));
    }

}
