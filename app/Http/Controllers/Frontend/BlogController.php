<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Blog;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function showBlog()
    {
    	$blogs = Blog::where(['status'=>1])->orderBy('id', 'desc')->paginate(4);
        return view('blog')->with(compact('blogs'));
    }
    public function showBlogDetails($id)
    {
        $blog = Blog::where(['status'=>1])->find($id);
        $reviews = Review::where('post_id', [$id])->where(['table_name'=>'blogs'])->orderBy('id', 'DESC')->get();
        return view('blog_details')->with(compact('blog','reviews'));
    }
    public function reviewSubmit(Request $request)
    {
        if (!isset(Auth::user()->id)) {
            return redirect()->back()->with('add_review_flash_error','Please login first...!');
        }
        if ($request->isMethod('post')) {
            // $date = $request->all();
            $review = new Review;
            $review->summery = $request->summery;
            $review->post_id = $request->post_id;
            $review->review = $request->massage;
            $review->table_name = 'blogs';
            $review->user_id = Auth::user()->id;
            $review->save();
            return redirect()->back()->with('add_review_flash_success','Review successfully submitted');
        }else{
            return redirect()->back()->with('add_review_flash_error','Something error.......!');
        }
    }
}
