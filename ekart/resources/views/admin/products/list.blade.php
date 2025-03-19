@extends('admin.layout.master')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Products ({{ $products->total() }}) </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Products Tables</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">

            <!-- /.card-header -->
            <div class="card-header">
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary pull-right">Add Product</a>
                @if (session()->has('message'))
                <p class="flashMessage">{{ session('message') }}</p>
            @endif
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>status</th>
                    <th>favorate</th>
                    <th style="width: 100">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('storage/images/'.$product->image) }}" width="100" alt="">
                    </td>

                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ number_format($product->price,2) }}</td>
                    <td>{{ $product->status_text }}</td>
                    <td>{{ $product->is_favourate_text }}</td>
                    <td>
                        <a href="{{ route('admin.product.edit',encrypt($product->id)) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('admin.product.delete',encrypt($product->id)) }}" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                    @endforeach


                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
       {{ $products->links() }}
            </div>
          </div>
          <!-- /.card -->


          <!-- /.card -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection

