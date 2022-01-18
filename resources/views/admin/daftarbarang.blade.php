@extends('/layouts/app')
@section('title','Daftar Item Barang')
@section('content')
<div class="col-lg-12">
    <div class="mb-2">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal"
      id="#myBtn"><i class="fas fa-plus"></i> Add Item </button>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#prosesImport"
       id="#modalCenter"><i class="fas fa-cloud-upload-alt"></i> Import</button>
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
    </div>
    @endif
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Daftar Item Barang</h4>
      </div>
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>Kode Barang</th>
              <th>Barcode</th>
              <th>Nama Barang</th>
              <th>Qty</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Kode Barang</th>
              <th>Barcode</th>
              <th>Nama Barang</th>
              <th>Qty</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach($item as $data)
            <tr>
              <td>{{ $data->kode_barang}}</td>
              <td>{{ $data->barcode}}</td>
              <td>{{ $data->nama_barang}}</td>
              <td>
                <?php
                  $sum = $data->qty;
                      foreach ($data->barangmasuk as $qty) {
                        $sum += $qty->qty;
                        // $sum -= 2;
                      }
                      foreach ($data->barangkeluar as $qty) {
                        $sum -= $qty->qty;
                        // $sum -= 2;
                      }
                      // echo $sum;
                      if ($sum > 0) {
                        echo $sum;
                      }else{
                        echo 0;
                      }
                ?>
              </td>
              <td>
                <a href="{{ route('edititem', $data->id) }}" class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i></a>
                <a href="{{ route('delete', $data->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="modal fade" id="prosesImport" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Import Daftar Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('importitem') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="file" value="">
                        <label class="custom-file-label" for="customFile">Masukan file</label>
                      </div>
                    </div>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Import</button>
                </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Item Baru</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('createitem') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputPassword1">Kode Barang</label>
                      <input type="text" class="form-control" name="kode_barang" placeholder="Kode Barang" required="">
                    </div>
                    <div class="form-group">
                        <label>Barcode</label>
                        <input type="text" class="form-control" name="barcode" placeholder="Barcode Barang" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama Barang</label>
                        <input type="text" class="form-control" placeholder="Nama Barang" name="nama_barang" required="">
                    </div>
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
@endsection