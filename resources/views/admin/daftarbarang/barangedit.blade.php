@extends('/layouts/app')
@section('title','Daftar Item Barang')
@section('content')
<div class="col-lg-12">
    <div class="mb-2">
    </div>
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Update Item Barang</h4>
      </div>
    </div>
    <form action="{{ route('updateitem', $edit->id) }}" method="POST">
        @csrf
        @method('PUT')
           <div class="form-group">
                  <label for="exampleInputPassword1">Kode Barang</label>
                  <input type="text" class="form-control" name="kode_barang" placeholder="Kode Barang" value="{{ $edit->kode_barang }}">
            </div>
            <div class="form-group">
                  <label>Barcode</label>
                  <input type="text" class="form-control" name="barcode" placeholder="Barcode Barang" value="{{ $edit->barcode }}">
            </div>
            <div class="form-group">
                   <label for="exampleInputPassword1">Nama Barang</label>
                   <input type="text" class="form-control" placeholder="Nama Barang" name="nama_barang" value="{{ $edit->nama_barang }}">
            </div>
                    <a href="{{ route('daftaritem') }}" class="btn btn-outline-danger" data-dismiss="modal">Kembali</a>
                    <button type="submit" name="submit" class="btn btn-primary">Update Data</button>
            </form>
@endsection