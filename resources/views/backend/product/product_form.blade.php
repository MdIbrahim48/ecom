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
                <h6 class="card-body-title">Add New Product </h6>
                <div class="col-xl-8 mg-t-25 mg-xl-t-0">
                  <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-info text-center">Add Product</h6>
                      @if (Session('success'))
                        <div class="alert alert-success">
                            <span>{{Session('success')}}</span>
                        </div>
                      @endif
                    <form action="{{route('productPost')}}" method="post" enctype="multipart/form-data">
                      @csrf
                        <div class="row row-xs">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Product Name</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{old('title')}}" placeholder="Product Name">
                                @error('title')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div><!-- row -->
                        <br>
                        <div class="row row-xs">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Product Permalink</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{old('slug')}}" placeholder="Product Permalink ">
                                @error('slug')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div><!-- row -->
                        <br>
                        <div class="row row-xs">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Category Name:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                                    <option value>Select Category</option>
                                    @foreach ($categories as $item)
                                        <option value="{{$item->id}}">{{$item->category_name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div><!-- row -->
                        <br>
                        <div class="row row-xs">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> SubCategory Name:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select class="form-control @error('subcategory_id') is-invalid @enderror" name="subcategory_id" id="subcategory_id">
                                    <option value>Select SubCategory</option>
                                    
                                </select>
                                @error('category_id')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div><!-- row -->
                        <br>
                        <div class="row row-xs">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Product Price</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{old('price')}}" placeholder="500">
                                @error('price')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div><!-- row -->
                        <br>
                        <div class="row row-xs">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Product Thumbnail</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail">
                                @error('thumbnail')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div><!-- row -->
                        <br>
                        <div class="row row-xs">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Product Summary</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <textarea name="summary" class="form-control @error('summary') is-invalid @enderror" id="summary" placeholder="Product Summary"></textarea>
                                @error('summary')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div><!-- row -->
                        <br>
                        <div class="row row-xs">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Product Description</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="summary" placeholder="Product Description"></textarea>
                                @error('description')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div><!-- row -->
                        <br>
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
@section('footer_js')
    <script>
        $('#title').keyup(function() {
            $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
        });

        $('#category_id').change(function(){
            let category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    type:'GET',
                    url:"{{url('admin/get-subcat-api')}}/"+category_id,
                    success:function(e){
                        if (e) {
                            $('#subcategory_id').empty();
                            $('#subcategory_id').append("<option value>Select One</option>");
                            $.each(e,function(key,value){
                                $('#subcategory_id').append('<option value="'+value.id+'">'+value.subcategory_name+'</option>')
                            })
                        } else {
                            $('#subcategory_id').empty();
                        }
                    }
                })
            } else {
                $('#subcategory_id').empty();
            }
        })
    </script>
@endsection