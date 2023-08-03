<?php

namespace App\Http\Controllers\Backend\Admin;

use Auth;
use Validator;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use App\Category;
use App\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function deleteBlog($id=null)
    {
        if (!empty($id)) {
            $data = Blog::FindOrFail($id);
            if (!empty($data->image)) {
                unlink('images/blog/'.$data->image);
            }
            Blog::find($id)->delete();
            return redirect()->back()->with('delete_blog_flash_success','audio successfully deleted');
        }
        
    }
    public function showBlogList($id=null)
    {
        $blogs = Blog::get();

        if (!empty($id)) {
            $blog = Blog::find($id);
            $blog->status = 1;

            $blog->save();
            return redirect()->back()->with('approved_blog_flash_success','Successfully approved',compact('blog'));
        }
        return view('admin.blog_list')->with(compact('blogs'));
    }
}
