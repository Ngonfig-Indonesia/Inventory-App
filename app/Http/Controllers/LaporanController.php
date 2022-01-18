<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        $data = BarangMasuk::with('daftaritem')->get();
        return view('/admin/laporanbarangmasuk', compact('data'));
    }

    public function search(Request $request)
    {
        if ($request->start_date || $request->end_date) {
            $tanggal_awal = date('Y-m-d',strtotime($request->start_date));
            $tanggal_akhir = date('Y-m-d',strtotime($request->end_date));
    
            $data = BarangMasuk::whereDate('created_at','>=',$tanggal_awal)->whereDate('created_at','<=',$tanggal_akhir)->get();
        }else{
            $data = BarangMasuk::with('daftaritem')->get();
        }
        return view('/admin/laporanbarangmasuk', compact('data'));
    }

    public function indexkeluar()
    {
        $laporankeluar = BarangKeluar::with('daftaritem')->get();
        return view('/admin/laporanbarangkeluar', compact('laporankeluar'));
    }

    public function searchkeluar(Request $request)
    {
        if ($request->start_date || $request->end_date) {
            $tanggal_awal = date('Y-m-d',strtotime($request->start_date));
            $tanggal_akhir = date('Y-m-d',strtotime($request->end_date));
    
            $laporankeluar = BarangKeluar::whereDate('created_at','>=',$tanggal_awal)->whereDate('created_at','<=',$tanggal_akhir)->get();
        }else{
            $laporankeluar = BarangKeluar::with('daftaritem')->get();
        }
        return view('/admin/laporanbarangkeluar', compact('laporankeluar'));
    }
}
