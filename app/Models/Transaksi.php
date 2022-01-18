<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';
    protected $fillable = ['transaksi','tanggal_keluar','crew_store','approve','user_approve'];
    
    public function barangkeluar()
    {
        return $this->hasMany(BarangKeluar::class);
    }

}
