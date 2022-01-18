@extends('/layouts/app')
@section('title','Barang Exp')
@section('content')
<div class="col-lg-12">
    <div class="mb-2">
    </div>
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Laporan Barang Keluar</h4>
      </div>
      <form action="{{ route('laporankeluarsearch') }}" method="get">
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
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Qty</th>
              <th>Satuan</th>
              <th>Tanggal Keluar</th>
              <th>Crew Store</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($laporankeluar as $Lbarangkeluar)
              <tr>
                <td>{{ $Lbarangkeluar->daftaritem->kode_barang }}</td>
                <td>{{ $Lbarangkeluar->daftaritem->nama_barang }}</td>
                <td>{{ $Lbarangkeluar->qty }}</td>
                <td>{{ $Lbarangkeluar->satuan }}</td>
                <td>{{ $Lbarangkeluar->transaksi->tanggal_keluar }}</td>
                <td>{{ $Lbarangkeluar->transaksi->crew_store }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    
@endsection