<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
class ProductController extends Controller
{
    public function productList(){
        $products = Product::paginate();
        $lastUrl = collect(request()->segments())->last();
        $last = Str::of($lastUrl)->replace('-',' ');
        return view('backend.product.product_list',[
            'last' => $last,
            'products' => $products
        ]);
    }
    public function productAdd(){
        $categories = Category::orderBy('category_name','asc')->get();
        return view('backend.product.product_form',[
            'categories' => $categories
        ]);
    }
    public function getSubCategory($cat_id){
        $sub_cat = SubCategory::where('category_id',$cat_id)->get();
        return response()->json($sub_cat);
    }
    public function productPost(ProductRequest $request){
        $product = new Product();
        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->summary = $request->summary;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();

        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $ext = Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $new = Product::findOrFail($product->id);
            $path = public_path('images/'.$new->created_at->format('Y/m/').$new->id.'/');
            File::makeDirectory($path,$mode = 0777,true,true);
            Image::make($image)->save($path . $ext);
            $new->thumbnail = $ext;
            $new->save();
        }
        return back()->with('success','Product Added Successfully');
    }
    public function productEdit($id){
        $categories = Category::orderBy('category_name','asc')->get();
        $editProducts = Product::findOrFail($id);
        return view('backend.product.product_edit',[
            'categories' => $categories,
            'editProducts' => $editProducts
        ]);
    }

}
