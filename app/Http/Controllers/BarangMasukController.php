<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\DaftarItem;
use Illuminate\Http\Request;
use Carbon\Carbon;
// use App\Models\Notice;
// use Illuminate\Support\Facades\Config;
// use Illuminate\Notifications\Notifiable;
// use App\Notifications\TelegramRegister;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangmasuk = BarangMasuk::with('daftaritem')->latest()->get();
        // return response()->json($barangmasuk, 200);
        return view('/admin/barangmasuk', compact('barangmasuk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
       BarangMasuk::create([
            'daftar_id' => $request->daftar_id,
            'qty' => $request->qty,
            'satuan' => $request->satuan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_exp' => $request->tanggal_exp,
            'supplier' => $request->supplier,
            'user_approve' => $request->user_approve
        ]);
        return back()->with('success',' Tambah Data Berhasil');
        return redirect()->route('barangmasuk');
    }

    public function search()
    {
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $barangmasuk = BarangMasuk::with('daftaritem')->whereBetween('created_at',[$start_date,$end_date])->get();
        } else {
            $barangmasuk = BarangMasuk::with('daftaritem')->get();
        }
        return view('/admin/barangmasuk', compact('barangmasuk'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = BarangMasuk::findOrFail($id);
        return view('/admin/barangmasuk/barangedit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = BarangMasuk::find($id)->update($request->all());
        return redirect()->route('barangmasuk');
        if ($update) {
            return back()->with('success',' Update Data Berhasil');
        } else {
            return back()->with('error',' Update Data Tidak Berhasil');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = BarangMasuk::find($id);
        $delete->delete();

        if ($delete) {
            return back()->with('success',' Penghapusan berhasil.');
        } else {
            return back()->with('error',' Penghapusan tidak berhasil.');
        }

    }
}
