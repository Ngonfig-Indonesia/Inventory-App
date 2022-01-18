<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Models\BarangMasuk;

class TelegramController extends Controller
{
    public function updatedActivity()
    {
        $activity = Telegram::getUpdates();
        // dd($activity);
    }

    public function index()
    {
        
        return view('/admin/telegram/send');
    }
    public function storeMessage(Request $request)
    {
        $barangmasuk = BarangMasuk::with('daftaritem')->get();
        foreach ($barangmasuk as $key => $values) {
            $tanggalmasuk = strtotime(date('d-m-Y'));
            $tanggalexp = strtotime($values->tanggal_exp);
            $hasil = $tanggalexp - $tanggalmasuk;
            $days = $hasil / 60 / 60 / 24;
            $namas = $values->daftaritem->nama_barang;
                if($days < 90){
                    $text = "== Alimart | Barang Expried ==\n"
                            . "<b>Nama Barang</b>\n"
                            . "$namas\n"
                            . "----------------------------\n"
                            . "<b>Selisih: </b>\n"
                            . "$days - Hari";

                Telegram::sendMessage([
                    'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                    'parse_mode' => 'HTML',
                    'text' => $text
                ]);
            }
        }
        // dd($text);
       
        return redirect()->back();
    }
}
