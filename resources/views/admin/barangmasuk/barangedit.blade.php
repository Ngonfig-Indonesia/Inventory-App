@extends('/layouts/app')
@section('title','Daftar Item Barang')
@section('content')
<div class="col-lg-12">
    <div class="mb-2">
    </div>
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Update Barang Masuk</h4>
      </div>
    </div>
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
    <form action="{{ route('update.barangmasuk', $edit->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="select2SinglePlaceholder">Daftar Item Barang</label>
            <input type="text" value="{{ $edit->daftaritem->nama_barang }}" class="form-control" disabled="">
            <input type="text" hidden="" name="daftar_id" value="{{ $edit->daftar_id}}">
          </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Qty</label>
          <input type="number" class="form-control" name="qty" value="{{ $edit->qty }}" placeholder="0">
        </div>
        <div class="form-group">
            <label>Satuan</label>
            <input type="text" class="form-control" name="satuan" value="{{ $edit->satuan }}" placeholder="pcs">
          </div>
        <div class="form-group" id="simple-date1">
            <label for="simpleDataInput">Tanggal Masuk</label>
              <div class="input-group date">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                <input type="text" name="tanggal_masuk" class="form-control" value="{{ $edit->tanggal_masuk }}" id="simpleDataInput">
              </div>
          </div>
          <div class="form-group" id="simple-date1">
            <label for="simpleDataInput">Tanggal Exp</label>
              <div class="input-group date">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                <input type="text" name="tanggal_exp" class="form-control" value="{{ $edit->tanggal_exp }}" id="simpleDataInput">
              </div>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Supplier</label>
            <input type="text" class="form-control" placeholder="Supplier" value="{{ $edit->supplier }}" name="supplier">
          </div>
            <a href="{{ route('barangmasuk')}}" class="btn btn-outline-danger" data-dismiss="modal">Kembali</a>
            <button type="submit" name="submit" class="btn btn-primary">Update Data</button>
        </form>
@endsection