@extends('/layouts/app')
@section('title','Update User')
@section('content')
<div class="col-lg-12">
    <div class="mb-2">
    </div>
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Update Data User</h4>
      </div>
      <div class="container-md">
        <div class="py col-lg-12">
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
          </div>
      </div>
    </div>
    
@endsection