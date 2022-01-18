@extends('/layouts/app')
@section('title','List Barang Keluar')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('storekeluar') }}" method="post">
            @csrf
            <div class="py-3 d-flex flex-row align-items-center justify-content-between">
                <h4 class="m-0 font-weight-bold text-primary">List Barang Keluar</h4>
            </div>
            <div class="font-left col-md-3 mb-2">
                <label for="">No Transaksi</label>
                <input type="text" name="transaksi" class="form-control col-lg-9" value="@php echo $cek @endphp">
            </div>
            <div class="d-flex">
                <div class="input-group col-md-3 mr-auto p-2">
                    <select data-allow-clear="1" hidden="" data-placeholder="Pencarian.." class="select-user form-control BtnAdd" name="daftar_id[]" id="daftar_id" data-allow-clear="1" required="" style="width: 300px; height: 600%;"></select>
                </div>
                <div class="p-1">
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Scanning <i class="fas fa-search fa-sm"></i></button> --}}
                </div>
              </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush table-hover" id="krimData">
                    <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>ID Barang</th>
                        <th>Qty</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <input type="text" name="user_id" class="form form-control" hidden="" value="{{ Auth::user()->id; }}">
                        <input type="text" name="satuan" class="form form-control" hidden="" value="pcs">
                        <input type="text" name="tanggal_keluar" class="form form-control" hidden="" value="@php echo date('d-m-Y') @endphp">
                        <input type="text" name="crew_store" class="form form-control" hidden="" value="{{ Auth::user()->name; }}">
                        <input type="text" name="approve" class="form form-control" hidden="" value="0">
                        <input type="number" hidden="" name="qty[]" class="form-control" width="100%" style="width: 80px;" value="0">
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary BtnSave mb-2">Kirim Data</button>
            </div>
        </div>
    </form>
</div>
{{-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Scanning Barcode</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="barcode">
                <video id="barcodevideo" autoplay></video>
                <canvas id="barcodecanvasg" ></canvas>
            </div>
            <canvas id="barcodecanvas" ></canvas>
            <div id="result"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div> --}}
@endsection
{{-- @push('script')
    <link rel="stylesheet" href="{{ asset('/scan/style.css') }}" />
    <script type="text/javascript" src="{{ asset('/scan/scan.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/scan/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/scan/barcode.js') }}"></script>
@endpush --}}