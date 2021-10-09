<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Image;
class ProductController extends Controller
{
    public function productList(){
        $products = Product::with(['category','ProductGallery'])->latest()->simplepaginate();
        $lastUrl = collect(request()->segments())->last();
        $last = Str::of($lastUrl)->replace('-',' ');
        return view('backend.product.product_list',[
            'last' => $last,
            'products' => $products
        ]);
    } 
    public function productAdd(){
        $categories = Category::orderBy('category_name','asc')->get();
        $brands = Brand::orderBy('brand_name','asc')->get();
        return view('backend.product.product_form',[
            'categories' => $categories,
            'brands' => $brands,
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
        $product->brand_id = $request->brand_id;
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
            Image::make($image)->save($path . $ext,80);
            $new->thumbnail = $ext;
            $new->save();
        }

        if($request->hasFile('image')){
            $images = $request->image;
            foreach($images as $image1){
                $img_ext = Str::slug($request->title).'-'.Str::random(3).'.'.$image1->getClientOriginalExtension();
                $path = public_path('images/product-gallery/'.$product->created_at->format('Y/m/').$product->id.'/');
                File::makeDirectory($path , $mode = 0777 , true,true);
                Image::make($image1)->save($path . $img_ext);
                $img = new ProductGallery();
                $img->product_id = $product->id;
                $img->image = $img_ext;
                $img->save();
            }
        }

        return back()->with('success','Product Added Successfully');
    }
    public function productEdit($id){
        $products = Product::findOrFail($id);
        $categories = Category::orderBy('category_name','asc')->get();
        $brands = Brand::orderBy('brand_name','asc')->get();
        $subCategories = SubCategory::where('category_id',$products->category_id)->orderBy('subcategory_name','asc')->get();
       
        return view('backend.product.product_edit',[
            'categories' => $categories,
            'products' => $products,
            'subCategories' => $subCategories,
            'brands' => $brands,
        ]);
    }

    public function productUpdate(Request $request){
        $product = Product::findOrFail($request->product_id);
        $product->title = $request->title;
        // $product->slug = $request->slug;

        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $ext = Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $old_path = public_path('images/'.$product->created_at->format('Y/m/').$product->id.'/'.$product->thumbnail);
            
            if(file_exists($old_path)){
               unlink($old_path);
            }

            $path = public_path('images/'.$product->created_at->format('Y/m/').$product->id.'/');
            File::makeDirectory($path,$mode = 0777,true,true);
            Image::make($image)->resize(284,294)->save($path . $ext);
            $product->thumbnail = $ext;
        }
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->summary = $request->summary;
        $product->description = $request->description;
        $product->price = $request->price;

        if($request->hasFile('image')){
            $images = $request->file('image');
            foreach($images as $key => $image){
                $pg = ProductGallery::findOrFail($request->gallery_id);

                $img_ext = Str::slug($request->title).'-'.Str::random(3).'.'.$image->getClientOriginalExtension();
                
                $path = public_path('images/product-gallery/'.$pg->created_at->format('Y/m/').$pg->product_id.'/');
                if(file_exists($path . $pg->image )){
                    unlink($path . $pg->image);
                }

                File::makeDirectory($path , $mode = 0777 , true,true);
                Image::make($image)->save($path . $img_ext);
                // $img = new ProductGallery();
                $pg->product_id = $product->id;
                $pg->image = $img_ext;
                $pg->save(); 
            }
        }

        $product->save();
        return redirect()->route('productList');
    }

}
