<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','daftar_id','transaksi_id','qty','satuan','tanggal_keluar','crew_store','approve'];
    protected $table = 'barang_keluars';
    public $incrementing = false;

    public function daftaritem()
    {
        return $this->belongsTo(DaftarItem::class, 'daftar_id');
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}
