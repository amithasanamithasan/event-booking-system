<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Validator;
use App\Admin;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Category;
use App\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class BlogController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }
    public function showBlogPostForm(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'title' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,gif',
            ]);
            // $date = $request->all();
            $blog = new Blog;
            $blog->title = $request->title;
            $blog->sub_title = $request->sub_title;
            $blog->description = $request->editor1;
            $blog->posted_by_id = Auth::user()->id;
            if ($request->hasFile('image')) {
                $dir = 'images/blog/';
                $extension = strtolower($request->file('image')->getClientOriginalExtension()); // get image extension
                $fileName = str_random() . '.' . $extension; // rename image
                $request->file('image')->move($dir, $fileName);
                $blog->image = $fileName;
            }
            
            $blog->save();
            return redirect(route('user.add-blog'))->with('add_blog_flash_success','Successfully addeded');
        }
        return view('user.add_new_blog');
    }
    public function showBlogList()
    {
        $posted_by_id = Auth::user()->id;
        $blogs = Blog::where(['posted_by_id'=>$posted_by_id])->get();
        return view('user.blog_list')->with(compact('blogs'));
    }
    public function deleteBlog($id=null)
    {
        if (!empty($id)) {
            $data = Blog::FindOrFail($id);
            if (!empty($data->image)) {
                unlink('images/blog/'.$data->image);
            }
            Blog::find($id)->delete();
            return redirect()->back()->with('delete_blog_flash_success','Blog successfully deleted');
        }
        
    }
    public function showEditBlogPostForm(Request $request,$id)
    {
        $blog = Blog::find($id);

        if ($request->isMethod('post')) {
            $this->validate($request,[
                'title' => 'required',
            ]);
            $blog->title = $request->title;
            $blog->sub_title = $request->sub_title;
            $blog->description = $request->editor1;
            $blog->posted_by_id = Auth::user()->id;
            if ($request->hasFile('image')) {
                $dir = 'images/blog/';
                if (!empty($blog->image)) {
                    unlink($dir.$blog->image );
                }
                $extension = strtolower($request->file('image')->getClientOriginalExtension()); // get image extension
                $fileName = str_random() . '.' . $extension; // rename image
                $request->file('image')->move($dir, $fileName);
                $blog->image = $fileName;
            }
            $blog->save();
            return redirect()->back()->with('upadte_blog_flash_success','Successfully updated');
        }
        return view('user.edit_blog')->with(compact('blog'));
    }
}
