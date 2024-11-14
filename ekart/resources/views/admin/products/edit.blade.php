@extends('admin.layout.master')
@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>General Form</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">edit Form</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Product</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('admin.product.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ encrypt($product->id) }}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}" placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="text" class="form-control" name="price" value="{{ $product->price }}" placeholder="Enter price">
                            </div>
                            <div class="form-group">
                                <label for="">Category</label>
                                <select name="category_id" class="form-control">
                                    <option value="">Select an option</option>
                                    @foreach ($categories as $category)
                                        <option @selected($category->id == $product->category_id) value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Status</label><br>
                                <input type="radio" @checked($product->status ==1) value="1" name="status"> Active
                                <input type="radio" @checked($product->status ==0)value="0" name="status"> Inactive
                            </div>
                            <div class="form-group">
                                <label for="">Is Favorite</label><br>
                                <input type="radio" @checked($product->is_favourate ==1) value="1" name="is_favourate"> Yes
                                <input type="radio" @checked($product->ia_favourate ==0) value="0" name="is_favourate"> No
                            </div>
                            <div class="form-group">
                                <label for=""> Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                       <input type="file" class="custom-file-input" name="image">
                                       <label for="" class="custom-file-label">choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">upload</span>
                                    </div>
                                </div>
                                <img src="{{ asset('images/'.$product->image) }}" width="100" alt="">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection
