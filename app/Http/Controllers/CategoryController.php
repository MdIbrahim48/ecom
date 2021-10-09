<?php

namespace App\Http\Controllers;
// use DB;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Str;
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
        $cat->slug = Str::slug($request->slug);
        $cat->save();
        return redirect('admin/category-list')->with('success','Category Added Successfully ');
    }
    public function categoryEdit($id){
        $category = Category::findOrFail($id);
        return view('backend/category/category_edit',compact('category'));
    }
    public function categoryUpdate(Request $request){
        $request->validate([
            'category_name' => 'required|min:3|max:50|unique:categories',
        ],[
            'category_name.required' => 'Please Enter Category Name '
        ]);
        // Category::findOrFail($request->category_id)->update([
        //     'category_name' => $request->category_name
        // ]);

        $category = Category::findOrFail($request->category_id);
        $category->category_name = $request->category_name;
        $category->save();
        return back();
    }
    public function categoryDelete($id){

        // $check = Product::where('category_id',$id)->count();
        // if($check > 0 ){
        //     $product = Product::where('category_id',$id)->update([
        //         'category_id' => 1
        //     ]);
        //     return "No Delete";
        // }else{
        //     return "Deleted";
        // }

        Category::findOrFail($id)->delete();
        return back()->with('delete','Category Deleted Successfully');
    }
    public function trashList(){
        $trash_list = Category::onlyTrashed()->paginate();
        return view('backend.category.trash_list',[
            'trash_list' => $trash_list
        ]);
    }
    public function trashRestore($id){
        Category::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success','Category Restore Successfully');
    }
    public function trashPermanentDeleted($id){
        Category::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('danger','Category Permanent Deleted Successfully');
    }
    public function categorySelectDeleted(Request $request){
        foreach ($request->delete as $cat_id) {
            Category::findOrFail($cat_id)->delete();
        }
        return back();
    }
}
