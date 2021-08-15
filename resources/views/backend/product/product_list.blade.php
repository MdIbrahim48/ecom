@extends('backend.master')
@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Starlight</a>
      <span class="breadcrumb-item active text-capitalize">{{$last??''}}</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row row-sm ">
          <div class="card pd-20 pd-sm-40 col-md-12">
            @if (Session('success'))
                <div class="alert alert-success">
                  <span>{{Session('success')}}</span>
                </div>
            @endif
            @if (Session('delete'))
                <div class="alert alert-danger">
                  <span>{{Session('delete')}}</span>
                </div>
            @endif
                <h6 class="card-body-title">Product List</h6>
                <h5 class="text-center">All Product </h5>
                <div class=""><a href="{{route('productAdd')}}" class="btn pull-right"><i class="fa fa-plus"></i> Add Product</a></div>
                <div class="table-responsive">
                <table class="table mg-b-0"> 
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Product Name</th>
                        <th>Slug</th>
                        <th>Summary</th>
                        <th>Category</th>
                        {{-- <th>Description</th> --}}
                        <th>Price</th>
                        <th>Thumbnail</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    @foreach($products as $key => $product)
                      <tbody>
                          <tr>
                            <td>{{$products->firstItem() + $key}}</td>
                            <td>{{$product->title}}</td>
                            <td>{{$product->slug}}</td>
                            <td>{{Str::limit($product->summary,20)}}</td>
                            <td>{{$product->category->category_name}}</td>
                            {{-- <td>{{$product->description	}}</td> --}}
                            <td>{{$product->price	}}</td>
                            <td><img width="100" src="{{asset('images/'.$product->created_at->format('Y/m/').$product->id.'/'.$product->thumbnail)}}" alt="{{$product->title}}"></td>
                            <td>{{$product->created_at != null ? $product->created_at->diffForHumans():'N/A'}}</td>
                            <td>{{$product->updated_at != null ? $product->updated_at->diffForHumans():'N/A'}}</td>
                            <td class="text-center">
                                <a href="{{route('productEdit',$product->id)}}" class="btn btn-outline-primary">Edit</a>
                                {{-- <a href="{{route('subCategoryDelete',$subcategory->id)}}" onclick="return confirm('Are You Deleted?')" class="btn btn-outline-danger">Delete</a> --}}
                            </td>
                        </tr>
                      </tbody>
                    @endforeach
                </table>
                {{-- {{$subcategories->links()}} --}}
                </div>
            </div><!-- card -->
           
          </div><!-- row -->
    </div><!-- sl-pagebody -->
    <footer class="sl-footer">
      <div class="footer-left">
        <div class="mg-b-2">Copyright &copy; 2017. Starlight. All Rights Reserved.</div>
        <div>Made by ThemePixels.</div>
      </div>
      <div class="footer-right d-flex align-items-center">
        <span class="tx-uppercase mg-r-10">Share:</span>
        <a target="_blank" class="pd-x-5" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//themepixels.me/starlight"><i class="fa fa-facebook tx-20"></i></a>
        <a target="_blank" class="pd-x-5" href="https://twitter.com/home?status=Starlight,%20your%20best%20choice%20for%20premium%20quality%20admin%20template%20from%20Bootstrap.%20Get%20it%20now%20at%20http%3A//themepixels.me/starlight"><i class="fa fa-twitter tx-20"></i></a>
      </div>
    </footer>
  </div><!-- sl-mainpanel -->
@endsection






