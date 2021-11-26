<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// models
use App\Models\Produk;

class JadwalPerakitan extends Model
{
    protected $table = 'jadwal_perakitan';
    protected $fillable = ['produk_id', 'jumlah', 'tanggal_mulai', 'tanggal_selesai', 'status', 'warna', 'konfirmasi_rencana', 'konfirmasi_perubahan', 'proses_konfirmasi'];

    public function Produk()
    {
        return $this->belongsTo(GudangBarangJadi::class, 'produk_id');
    }
}
