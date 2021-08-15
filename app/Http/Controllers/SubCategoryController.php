<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Str;
class SubCategoryController extends Controller
{
    public function subCategoryList(){
        return view('backend.subcategory.subcategory_list',[
            'subcat_count' => SubCategory::count(),
            'subcategories' => SubCategory::orderBy('subcategory_name','asc')->paginate(5)
        ]);
    }
    public function subCategoryAdd(){
        return view('backend.subcategory.subcategory_form',[
            'categories' => Category::orderBy('category_name','asc')->get()
        ]);
    }
    public function subCategoryPost(Request $request){
        $request->validate([
            'subcategory_name' => 'required|unique:sub_categories',
            'category_id' => 'required'
        ],[
            'category_id.required' => "Please Select Category"
        ]);
        $scat = new SubCategory;
        $scat->subcategory_name	= $request->subcategory_name;
        $scat->category_id	= $request->category_id;
        $scat->slug	= Str::slug($request->subcategory_name);
        $scat->save();
        return back()->with('success','SubCategory Addedd Successfull');
    }
    public function subCategoryEdit($id){
        $scat = SubCategory::findOrFail($id);
        return view('backend.subcategory.subcategory_edit',[
            'scat' => $scat,
            'categories' => Category::orderBy('category_name','asc')->get()
        ]);
    }
    public function subCategoryUpdate(Request $request){
        $request->validate([
            'subcategory_name' => 'required|unique:sub_categories',
            'category_id' => 'required'
        ],[
            'category_id.required' => "Please Select Category"
        ]);
        $scat = SubCategory::findOrFail($request->id);
        $scat->subcategory_name	= $request->subcategory_name;
        $scat->category_id	= $request->category_id;
        $scat->slug	= Str::slug($request->subcategory_name);
        $scat->save();
        return redirect(route('subCategoryList'))->with('success','SubCategory Update Successfull');
    }
    public function subCategoryDelete($id){
        SubCategory::findOrFail($id)->delete();
        return redirect()->route('subCategoryList')->with('delete','SubCategory Deleted Successfully');;
    }
}
