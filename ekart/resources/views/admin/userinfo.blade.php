@extends('admin.layout.master')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>UserInfo ({{ $userinfos->total() }}) </h1>
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

            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>

                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>


                    <th style="width: 100">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($userinfos as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>


                    <td>{{ $user->name }}</td>


                    <td>{{ $user->email }}</td>
                    <td>********</td>
                    <td>
                        <a href="{{route('admin.useredit', ['id' => encrypt($user->id)]) }}" class="btn btn-primary btn-sm">Edit</a>
                        

                        <a href="{{ route('admin.userdelete', ['id' => encrypt($user->id)]) }}" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                    @endforeach


                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
       {{ $userinfos->links() }}
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

