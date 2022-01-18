<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Models\BarangMasuk;

class UpdateTelegram extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:telegram';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Running Update Notice on Telegram...';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $barangmasuk = BarangMasuk::with('daftaritem')->get();
        foreach ($barangmasuk as $key => $values) {
            $tanggalmasuk = strtotime(date('d-m-Y'));
            $tanggalexp = strtotime($values->tanggal_exp);
            $hasil = $tanggalexp - $tanggalmasuk;
            $days = $hasil / 60 / 60 / 24;
            $namas = $values->daftaritem->nama_barang;
            if($days > 0){
                if($days > 90){
        
                }else{
                    $text = "== Alimart | Barang Expired ==\n"
                    . "<b>Nama Barang</b>\n"
                    . "$namas\n"
                    . "----------------------------\n"
                    . "<b>Selisih: </b>\n"
                    . "$days - Hari";

                    $update = Telegram::sendMessage([
                        'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                        'parse_mode' => 'HTML',
                        'text' => $text
                    ]);

                    $returnVar = NULL;
                    $output = NULL;

                    exec($update,$returnVar,$output);
                }
                
            }else{
                $text = "== Alimart | Barang Expired ==\n"
                . "<b>Nama Barang</b>\n"
                . "$namas\n"
                . "----------------------------\n"
                . "<b>Selisih: </b>\n"
                . "Sudah Expried";

                $update = Telegram::sendMessage([
                    'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                    'parse_mode' => 'HTML',
                    'text' => $text
                ]);

                $returnVar = NULL;
                $output = NULL;

                exec($update,$returnVar,$output);
            }
                
        }
    }
}
