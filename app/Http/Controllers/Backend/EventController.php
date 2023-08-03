<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Validator;
use App\Admin;
use App\User;
use Illuminate\Support\Facades\Hash;

use App\Category;
use App\Events;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
class EventController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // } 
    public function showEventPostForm(Request $request)
    {
    	$categories = Category::where(['parent_id'=>Auth::user()->org_type_id])->get();
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'category_id' => 'required',
                'title' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,gif|max:2024',
            ]);
            // $date = $request->all();
            $event = new Events;
            $event->category_id = $request->category_id;
            $event->title = $request->title;
            $event->sub_title = $request->sub_title;
            $event->location = $request->location;
            $event->description = $request->description;
            $event->posted_by_id = Auth::user()->id;

            if ($request->hasFile('image')) {
                $dir = 'images/events/';
                $extension = strtolower($request->file('image')->getClientOriginalExtension()); // get image extension
                $fileName = str_random() . '.' . $extension; // rename image
                $request->file('image')->move($dir, $fileName);
                $event->image = $fileName;
            }
            $event->save();
            return redirect(route('user.add-event'))->with('add_event_flash_success','Successfully addeded');
        }
    	return view('user.add_new_event')->with(compact('categories'));
    }

    public function showEventList()
    {
        $posted_by_id = Auth::user()->id;
        $events = Events::where(['posted_by_id'=>$posted_by_id])->get();
        return view('user.show_events')->with(compact('events'));
    }
    public function showEditeventPostForm(Request $request,$id)
    {
        $event = Events::find($id);
        $categories = Category::where(['parent_id'=>Auth::user()->org_type_id])->get();

        if ($request->isMethod('post')) {
           $this->validate($request,[
                'category_id' => 'required',
                'title' => 'required',
            ]);
            // $date = $request->all();
            $event->category_id = $request->category_id;
            $event->title = $request->title;
            $event->sub_title = $request->sub_title;
            $event->location = $request->location;
            $event->description = $request->description;
            $event->posted_by_id = Auth::user()->id;
            if ($request->hasFile('image')) {
                if (!empty($event->image)) {
                    unlink('images/events/'.$event->image);
                }
                $dir = 'images/events/';
                $extension = strtolower($request->file('image')->getClientOriginalExtension()); // get image extension
                $fileName = str_random() . '.' . $extension; // rename image
                $request->file('image')->move($dir, $fileName);
                $event->image = $fileName;
            }
            
            $event->save();
            return redirect()->back()->with('upadte_event_flash_success','Successfully updated');
        }
        return view('user.edit_event')->with(compact('categories','event'));
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
