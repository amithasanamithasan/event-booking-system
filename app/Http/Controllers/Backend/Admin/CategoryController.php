<?php

namespace App\Http\Controllers\Backend\Admin;

use Auth;
use Validator;
use App\Admin;
use App\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function addCategory(Request $request){
    	if ($request->isMethod('post')) {
	        $this->validate($request,[
	            'category_name' => 'required',
	            // 'img' => 'required|mimes:jpeg,jpg,png,gif',
	            // 'url' => 'required',
	        ]);
	        // $date = $request->all();
	        $category = new Category;
	        $category->name = $request->category_name;
	        $category->parent_id = $request->parent_id;
	        $category->description = $request->description;
            $category->url = $request->url;

            if ($request->hasFile('img')) {
                $dir = 'images/categories/';
                $extension = strtolower($request->file('img')->getClientOriginalExtension()); // get image extension
                $fileName = str_random() . '.' . $extension; // rename image
                $request->file('img')->move($dir, $fileName);
                $category->img = $fileName;
            }

	        $category->save();
	        return redirect(route('admin.add-category'))->with('add_category_flash_success','Successfully addeded');
    	}
    	$levels = Category::where(['parent_id'=>0])->get();
    	return view('admin.categories.add_category')->with(compact('levels'));
    }

    public function showCategory(){
    	$categories = Category::get();
    	return view('admin.categories.view_category')->with(compact('categories'));
    }

    public function editCategory(Request $request, $id=null){
    	if ($request->isMethod('post')) {
	        $this->validate($request,[
	            'category_name' => 'required',
	            // 'description' => 'required',
	            // 'url' => 'required',
	        ]);
	        $category = Category::find($id);
	        $category->name = $request->category_name;
            $category->parent_id = $request->parent_id;
	        $category->description = $request->description;
	        $category->url = $request->url;
            if ($request->hasFile('img')) {
                $dir = 'images/categories/';
                $extension = strtolower($request->file('img')->getClientOriginalExtension()); // get image extension
                $fileName = str_random() . '.' . $extension; // rename image
                $request->file('img')->move($dir, $fileName);
                $category->img = $fileName;
            }
	        $category->save();
	        return redirect(route('admin.show-category'))->with('edit_category_flash_success','Successfully updated');
    	}
    	$levels = Category::where(['parent_id'=>0])->get();
    	$categoryDetails = Category::where(['id'=>$id])->first();
    	return view('admin.categories.edit_category')->with(compact('categoryDetails','levels'));
    }

    public function deleteCategory($id=null)
    {
    	if (!empty($id)) {
    		$data = Category::FindOrFail($id);
            if (!empty($data->img)) {
                unlink('images/categories/'.$data->img);
            }
        	Category::find($id)->delete();
        	return redirect()->back()->with('edit_category_flash_success','Category successfully deleted');
    	}
        
    }
}
