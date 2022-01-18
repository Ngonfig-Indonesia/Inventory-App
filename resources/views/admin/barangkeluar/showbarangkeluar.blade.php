@extends('/layouts/app')
@section('title','Show List Barang')
@section('content')
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
<div class="card">
    <div class="card-body">
            <div class="py-3 d-flex flex-row align-items-center justify-content-between">
                <h4 class="m-0 font-weight-bold text-primary">List Barang Keluar</h4>
            </div>
            <div class="font-left col-md-3 mb-2">
                <label for="">No Transaksi</label>
                <input type="text" name="transaksi" class="form-control col-lg-9" value="{{ $showBarang->transaksi }}">
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush table-hover" id="krimData">
                    <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 0;
                        @endphp
                         @foreach ($showBarang->barangkeluar as $item => $values)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>
                                {{ $values->daftaritem->nama_barang }}
                            </td>
                            <td>{{ $values->qty }}</td>
                            <td>
                                <a href="{{ route('delete.list', $values->id)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach                    
                    </tbody>
                </table>
                <form action="{{ route('approve.list', $showBarang->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="custom-control custom-radio mt-3">
                        <input type="radio" id="customRadio1" name="approve" required="" class="custom-control-input" value="2">
                        <label class="custom-control-label" for="customRadio1">Setuju</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio2" name="approve" required="" class="custom-control-input" value="1">
                        <input type="text" name="user_approve" hidden="" value="{{ Auth::user()->name }}">
                        <label class="custom-control-label" for="customRadio2">Tidak Setuju</label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Kirim Data</button>
                <a href="{{ route('listbarang') }}" class="btn btn-danger mt-2">Kembali</a>
            </form>
            </div>
        </div>
    
</div>
@endsection