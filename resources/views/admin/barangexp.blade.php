@extends('/layouts/app')
@section('title','Barang Exp')
@section('content')
<div class="col-lg-12">
    <div class="mb-2">
    </div>
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Daftar Barang Exp</h4>
      </div>
      <div class="font-left col-3">
        <div class="badge badge-grey">Keterangan : </div>
        <div class="badge badge-success">Belum Expired</div>
        <div class="badge badge-warning">Menunggu Expired</div>
        <div class="badge badge-danger">Sudah Expired</div>
      </div>
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Satuan</th>
              <th>Tanggal Masuk</th>
              <th>Tanggal Exp</th>
              <th>Selisih Hari</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($barangexp as $brgexp)
            <tr>
              <td>{{ $brgexp->daftaritem->kode_barang }}</td>
              <td>{{ $brgexp->daftaritem->nama_barang }}</td>
              <td>{{ $brgexp->satuan }}</td>
              <td>{{ $brgexp->tanggal_masuk}}</td>
              <td>{{ $brgexp->tanggal_exp}}</td>
              <td>
                  @php
                      $tanggalmasuk = strtotime(date('d-m-Y'));
                      $tanggalexp = strtotime($brgexp->tanggal_exp);
                      $hasil = $tanggalexp - $tanggalmasuk;
                      $days = $hasil / 60 / 60 / 24;
                  @endphp
                 @if ($days > 0)
                   @if ($days > 90)
                    <div class="badge badge-success">{{ $days }} Hari</div>
                   @else
                    <div class="badge badge-warning">{{ $days }} Hari</div>
                   @endif
                 @else
                  <div class="badge badge-danger">Expried</div>
                 @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
@endsection