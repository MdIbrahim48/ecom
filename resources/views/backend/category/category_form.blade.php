@extends('backend.master')

@section('content')
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Starlight</a>
      <a class="breadcrumb-item" href="{{url('dashboard')}}">Dashboard</a>
    </nav>

    <div class="sl-pagebody">
        <div class="row row-sm ">
            <div class="card pd-20 pd-sm-40 col-md-12">
                <h6 class="card-body-title">Add New Category </h6>
                <div class="col-xl-8 mg-t-25 mg-xl-t-0">
                  <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-info text-center">Add Category</h6>
                      @if (Session('success'))
                        <div class="alert alert-success">
                            <span>{{Session('success')}}</span>
                          </div>
                      @endif
                    <form action="{{url('admin/category-post')}}" method="post">
                      @csrf
                        <div class="row row-xs">
                        <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Add Category:</label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{old('category_name')}}" placeholder="Add Category">
                            @error('category_name')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                          </div>
                        </div><!-- row -->
                        <div class="row row-xs mg-t-30">
                        <div class="col-sm-8 mg-l-auto">
                            <div class="form-layout-footer">
                            <button type="submit" class="btn btn-info mg-r-5" style="cursor: pointer">Submit Form</button>
                            </div><!-- form-layout-footer -->
                        </div><!-- col-8 -->
                        </div>
                    </form>
                  </div><!-- card -->
              </div><!-- col-6 -->  
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