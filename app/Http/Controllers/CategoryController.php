<?php

namespace App\Http\Controllers;
// use DB;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
class CategoryController extends Controller
{
    public function categoryList(){
        $categories = Category::orderBy('id','desc')->simplepaginate(5);
        $cat_count = Category::count();
        return view('backend.category.category_list',[
            'categories' => $categories,
            'cat_count'  => $cat_count
        ]);
    }
    
    public function categoryAdd(){
        return view('backend.category.category_form');
    }
    public function categoryPost(Request $request){ 
        $request->validate([
            'category_name' => 'required|min:3|max:50|unique:categories',
        ],[
            'category_name.required' => 'Please Enter Category Name '
        ]);

        $cat = new Category;
        $cat->category_name = $request->category_name;
        $cat->save();
        return redirect('admin/category-list')->with('success','Category Added Successfully ');
    }
    public function categoryEdit($id){
        $category = Category::findOrFail($id);
        return view('backend/category/category_edit',compact('category'));
    }
    public function categoryUpdate(Request $request){
        // Category::findOrFail($request->category_id)->update([
        //     'category_name' => $request->category_name
        // ]);

        $category = Category::findOrFail($request->category_id);
        $category->category_name = $request->category_name;
        $category->save();
        return back();
    }
    public function categoryDelete($id){
        Category::findOrFail($id)->delete();
        return back()->with('delete','Category Deleted Successfully');
    }
}
