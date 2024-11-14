@extends('admin.layout.master')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Products ({{ $payments->total() }}) </h1>
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

                    <th>Name</th>
                    <th>quantity</th>
                    <th>amount</th>
                    <th>payername</th>
                    <th>payment_status</th>
                    <th>payment_method</th>
                    <th style="width: 100">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                <tr>
                    <td>{{ $loop->iteration }}</td>


                    <td>{{ $payment->product_name }}</td>
<td>{{ $payment->quantity }}</td>
<td>{{ $payment->amount}}</td>
<td>{{ $payment->payer_name}}</td>
<td>{{ $payment->payment_status}}</td>
<td>{{ $payment->payment_method}}</td>

                    <td>
                        <a href="" class="btn btn-primary btn-sm">Edit</a>
                        <a href="" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                    @endforeach


                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
       {{ $payments->links() }}
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

