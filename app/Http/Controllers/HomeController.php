<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarItem;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function home()
    {
        $jumlah_barang = DaftarItem::count();
        $barangkeluar = BarangKeluar::count();
        $barangmasuk = BarangMasuk::count();
      
        $chart = BarangMasuk::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))->where('created_at', '>', Carbon::today()->subDay(6))->groupBy('day_name','day')->orderBy('day')->get();

        $data = [];
 
            foreach($chart as $row) {
                $data['label'][] = $row->day_name;
                $data['data'][] = (int) $row->count;
            }
        
        $data['chart_data'] = response()->json($data);
        

            // dd($data);
            $barangexp = BarangMasuk::select('tanggal_exp')->get();
            return view('/admin/dashboard', compact('jumlah_barang','barangkeluar','barangmasuk','barangexp'));
    }
    public function homeuser()
    {
        return view('/user/dashboard');
    }
}
