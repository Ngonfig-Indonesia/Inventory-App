@extends('/layouts/app')
@section('title','Dashboard')
@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </div>
  <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <h6><i class="fas fa-check"></i><b> Success</b></h6>
    <h5>Selamat Datang {{Auth::user()->name }} </h5>
  </div>
  <!--Row-->
  <!-- Modal Logout -->
@endsection
