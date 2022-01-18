@extends('/layouts/app')
@section('title','Tambah User')
@section('content')
@if (session('success'))
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h6><i class="fas fa-check"></i><b> Success!</b></h6>
          {{ session('success')}}
      </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <h6><i class="fas fa-ban"></i><b> Stop!</b></h6>
      {{ session('error')}}
    @endif
<div class="table-responsive p-3">
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModalCenter"
    id="#modalCenter">Add User</button>
    <table class="table align-items-center table-flush table-hover">
      <thead class="thead-light">
        <tr>
          <th>Nama User</th>
          <th>Email</th>
          <th>Level</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($userdata as $user)
          <tr>
            <td>{{ $user->name}}</td>
            <td>{{ $user->email}}</td>
            <td>{{ $user->level}}</td>
            <td>
              <a href="{{ route('user_id', $user->id) }}" class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i></a>
              <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
            </td>
          </tr>
          @endforeach
      </tbody>
    </table>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Form Tambah User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                  <!-- Form Basic -->
                    <div class="row justify-content-center">
                      <div class="col-xl-12 ">
                        <div class="card shadow-sm">
                          <div class="card-body p-0">
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="login-form">
                                  <form action="{{ route('cek_register') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                      <label>Username</label>
                                      <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter First Name" name="name">
                                    </div>
                                    <div class="form-group">
                                      <label>Email</label>
                                      <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Email Address" required="" name="email">
                                    </div>
                                    <div class="form-group">
                                      <label>Password</label>
                                      <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" required="" name="password">
                                    </div>
                                    <div class="form-group">
                                      <label>Repeat Password</label>
                                      <input type="password" class="form-control" id="exampleInputPasswordRepeat"
                                        placeholder="Repeat Password" required="" name="password_confirmation">
                                    </div>
                                    <div class="form-group">
                                      <label>Hak Akses</label>
                                      <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio3" name="level" value="admin" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio3">Admin</label>
                                      </div>
                                      <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio4" name="level" value="cs" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio4">Crew Store</label>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <button type="submit" class="btn btn-primary btn-block">Register</button>
                                    </div>
                                  </form>
                                  <div class="text-center">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
  </div>
@endsection