@extends('backend.master')
@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Starlight</a>
      <span class="breadcrumb-item active">Dashboard</span>
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
                <h6 class="card-body-title">Category List</h6>
                <h5 class="text-center">All Category {{$cat_count}}</h5>
                <div class=""><a href="{{url('admin/category-add')}}" class="btn pull-right"><i class="fa fa-plus"></i> Add Category</a></div>
                <div class="table-responsive">
                <table class="table mg-b-0">
                    <form action="{{url('admin/selected/category-deleted')}}" method="post"> 
                    <thead>
                    <tr>
                        <th>
                          <button type="submit" class="btn btn-danger">Delete</button>
                          <input type='checkbox' id="checkAll" value="All">All
                        </th>
                        <th>Id</th>
                        <th>Category Name</th>
                        <th>Total Product</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    @csrf
                    @foreach($categories as $key => $category)
                      <tbody>
                          <tr>
                            <td><input type="checkbox" name="delete[]" value="{{$category->id}}"></td>
                            <td>{{$categories->firstItem() + $key}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>{{$category->product->count()}}</td>
                            <td>{{$category->created_at != null ? $category->created_at->diffForHumans():'N/A'}}</td>
                            <td>{{$category->updated_at != null ? $category->updated_at->diffForHumans():'N/A'}}</td>
                            <td class="text-center">
                                <a href="{{url('admin/category-edit')}}/{{$category->id}}" class="btn btn-outline-primary">Edit</a>
                                <a href="{{url('admin/category-delete')}}/{{$category->id}}" onclick="return confirm('Are You Deleted?')" class="btn btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                      </tbody>
                    @endforeach
                    </form>
                </table>
                {{$categories->links()}}
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






