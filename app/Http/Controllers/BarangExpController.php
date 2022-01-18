<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarItem;
use App\Models\BarangMasuk;

class BarangExpController extends Controller
{
    public function index()
    {
        $barangexp = BarangMasuk::with('daftaritem')->latest()->get();
        // foreach ($barangexp as $key) {
        //     $tanggalmasuk = strtotime(date('d-m-Y'));
        //     $tanggalexp = strtotime($key->tanggal_exp);
        //     $hasil = $tanggalexp - $tanggalmasuk;
        //     $days[] = $hasil / 60 / 60 / 24;
        // }
        return view('/admin/barangexp', compact('barangexp'));
    }
}
