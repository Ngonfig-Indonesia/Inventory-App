@extends('/layouts/app')
@section('title','Barang Keluar')
@section('content')
<div class="col-lg-12">
    <div class="mb-2">
    </div>
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Daftar List Barang Keluar</h4>
      </div>
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHovers">
          <thead class="thead-light">
            <tr>
              <th>No</th>
              <th>No Transaksi</th>
              <th>Tanggal Keluar</th>
              <th>Crew Store</th>
              <th>Status</th>
              <th>Admin Approve</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @php
                $no = 0;
            @endphp
            @foreach($listbarangkeluar as $transaksis) 
            <tr>
              <td>{{ ++$no }}</td>
              <td>{{ $transaksis->transaksi->transaksi}}</td>
              <td>{{ $transaksis->transaksi->tanggal_keluar}}</td>
              <td><div class="badge badge-success">{{ $transaksis->transaksi->crew_store}}</div></td>
              <td>
                @if ($transaksis->transaksi->approve == 0)
                    <div class="badge badge-warning">Pending</div>
                @elseif($transaksis->transaksi->approve == 1)
                  <div class="badge badge-danger">Failed</div>
                @else
                <div class="badge badge-success">Success</div>
                @endif
              </td>
              <td>
                @if ($transaksis->transaksi->user_approve == "")
                  <div class="badge badge-warning">Pending Approve</div>
                @else
                  <div class="badge badge-primary">{{ Auth::user()->name }}</div>
                @endif
              </td>
              <td>
                  <a href="{{ route('showlistbarangkeluar', $transaksis->transaksi_id )}}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
@endsection