<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::latest()->get();
        return view('/user/barangkeluar', compact('transaksi'));
    }
    public function listbarangkeluar()
    {
        $listbarangkeluar = BarangKeluar::with('transaksi')->select("*")->groupBy('transaksi_id')->latest()->get();
        // dd($listbarangkeluar);
        return view('/admin/daftarbarangkeluar', compact('listbarangkeluar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $barangkeluar = BarangMasuk::with('daftaritem')->whereBetween('created_at',[$start_date,$end_date])->get();
        } else {
            $barangkeluar = BarangMasuk::with('daftaritem')->get();
        }
        return view('/user/barangkeluar', compact('barangkeluar'));
    }

    public function listbarang()
    {
        $no = 1;
        $kode_item = BarangKeluar::count();
        $no += $kode_item;
        $test = sprintf("%03s", $no);
        $nama = 'Alimart/Gudang';
        $krakter = '/';
        $tanggal = date('d/m/Y');
        $cek = $nama.$krakter.$tanggal.$krakter.$test;
        return view('/user/listbarang/listbarangkeluar', compact('cek'));
    }

    public function showBarangKeluar($id)
    {
        $showBarang = Transaksi::with('barangkeluar.daftaritem')->findOrFail($id);
        // dd($showBarang);
        return view('/admin/barangkeluar/showbarangkeluar', compact('showBarang'));
    }

    public function approve(Request $request, $id)
    {
        $update = Transaksi::with('barangkeluar.daftaritem')->findOrFail($id)->update($request->all());
        return redirect()->route('listbarang');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {           
        $data = new Transaksi;
        $data->transaksi = $request->transaksi;
        $data->tanggal_keluar = $request->tanggal_keluar;
        $data->crew_store = $request->crew_store;
        $data->save();

        $qty = $request->qty;
        foreach($request->daftar_id as $i => $cek){
                $data->barangkeluar()->create([
                'daftar_id' => $cek,
                'user_id' => $request->user_id,
                'qty' => $qty[$i],
                'satuan' => $request->satuan
                ]);
        }
        return redirect()->route('barangkeluar');
        // dd($barangkeluar);  
        // $data->barangkeluar()->save($barangkeluar);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function scan()
    {
       return view('/user/listbarang/scan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = BarangKeluar::find($id);
        $delete->delete();
        if ($delete) {
            return back()->with('success',' Penghapusan berhasil.');
        } else {
            return back()->with('error',' Penghapusan tidak berhasil.');
        }
    }

    public function delete($id)
    {
        $hapus = BarangKeluar::findOrFail($id);
        $hapus->delete();
        if ($hapus) {
            return back()->with('success',' Penghapusan berhasil.');
        } else {
            return back()->with('error',' Penghapusan tidak berhasil.');
        }
        return redirect()->route('showlistbarangkeluar');
    }

}
