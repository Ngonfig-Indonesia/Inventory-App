@extends('/layouts/app')
@section('title','Barang Keluar')
@section('content')
<div class="col-lg-12">
    <div class="mb-2">
      <a href="{{ route('list.barang') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Barang Keluar
      </a>
    </div>
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Daftar Barang Keluar</h4>
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
            </tr>
          </thead>
          <tbody>
            @php
                $no = 0;
            @endphp
            @foreach($transaksi as $transaksis) 
            <tr>
              <td>{{ ++$no }}</td>
              <td>{{ $transaksis->transaksi}}</td>
              <td>{{ $transaksis->tanggal_keluar}}</td>
              <td>{{ $transaksis->crew_store}}</td>
              <td>
                @if ($transaksis->approve == 0)
                    <div class="badge badge-warning">Pending</div>
                @elseif($transaksis->approve == 1)
                    <div class="badge badge-danger">Failed</div>
                @else
                    <div class="badge badge-success">Success</div>
                @endif
              </td>
              <td>
                @if ($transaksis->user_approve == "")
                <div class="badge badge-warning">Pending Approve</div>
                @else
                  <div class="badge badge-primary">{{ $transaksis->user_approve }}</div>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
@endsection