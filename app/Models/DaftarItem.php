<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarItem extends Model
{
    use HasFactory;
    protected $fillable = ['kode_barang','barcode','nama_barang','qty'];
    protected $table = 'daftar_items';

    public function barangmasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'daftar_id');
    }

    public function barangkeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'daftar_id');
    }
}
