<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $fillable = ['daftar_id','qty','satuan','tanggal_masuk','tanggal_exp','supplier','user_approve'];
    protected $table = 'barang_masuks';

    public function daftaritem()
    {
        return $this->belongsTo(DaftarItem::class, 'daftar_id');
    }
}
