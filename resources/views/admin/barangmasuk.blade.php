@extends('/layouts/app')
@section('title','Barang Masuk')
@section('content')
<div class="col-lg-12">
    <div class="mb-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
        id="#myBtn"><i class="fas fa-plus"></i> Barang Masuk
      </button>
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
    </div>
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Daftar Barang Masuk</h4>
      </div>
      <form action="{{ route('searchmasuk') }}" method="get">
        <div class="form-group" id="simple-date4">
          <div class="input-daterange input-group col-md-3">
            <input type="text" class="input-sm form-control" name="start_date" placeholder="Mulai Tanggal" autocomplete="off"/>
            <div class="input-group-prepend">
              <span class="input-group-text">to</span>
            </div>
            <input type="text" class="input-sm form-control" name="end_date" placeholder="Sampai Tanggal" autocomplete="off"/>
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </form>
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHovers">
          <thead class="thead-light">
            <tr>
              <th>Nama Barang</th>
              <th>Qty</th>
              <th>Satuan</th>
              <th>Tanggal Masuk</th>
              <th>Tanggal Exp</th>
              <th>Supplier</th>
              <th>User Terima</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($barangmasuk as $brgmasuk)
              <tr>
                <td>{{ $brgmasuk->daftaritem->nama_barang}}</td>
                <td>{{ $brgmasuk->qty}}</td>
                <td>{{ $brgmasuk->satuan}}</td>
                <td>{{ $brgmasuk->tanggal_masuk}}</td>
                <td>{{ $brgmasuk->tanggal_exp}}</td>
                <td>{{ $brgmasuk->supplier}}</td>
                <td>{{ $brgmasuk->user_approve}}</td>
                <td>
                    <a href="{{ route('edit.barangmasuk', $brgmasuk->id) }}" class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i></a>
                    <a href="{{ route('delete.barangmasuk', $brgmasuk->id )}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Barang Masuk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                  <!-- Form Basic -->
                  <div class="card mb-4">
                    <div class="card-body">
                      <form action="{{ route('storemasuk') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="select2SinglePlaceholder">Daftar Item Barang</label>
                            <select class="select2-single-placeholder form-control" data-width="100%" required="" style="width: 100%;" name="daftar_id">
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Qty</label>
                          <input type="number" class="form-control" name="qty" placeholder="0" required="">
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" class="form-control" name="satuan" placeholder="pcs" required="">
                          </div>
                        <div class="form-group" id="simple-date1">
                            <label for="simpleDataInput">Tanggal Masuk</label>
                              <div class="input-group date">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="text" name="tanggal_masuk" class="form-control" required="" value="@php echo date('d-m-Y') @endphp" id="simpleDataInput">
                              </div>
                          </div>
                          <div class="form-group" id="simple-date1">
                            <label for="simpleDataInput">Tanggal Exp</label>
                              <div class="input-group date">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="text" name="tanggal_exp" class="form-control" required="" value="@php echo date('d-m-Y') @endphp" id="simpleDataInput">
                              </div>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Supplier</label>
                            <input type="text" class="form-control" placeholder="Supplier" required="" name="supplier">
                            <input type="text" name="user_approve" hidden="" value="{{ Auth::user()->name }}">
                          </div>
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>
                        </form>
                    </div>
                  </div>
            </div>
        </div>
    </div>
  </div>
@endsection