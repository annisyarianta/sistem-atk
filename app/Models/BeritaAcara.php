<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    protected $table = 'berita_acara';
    protected $primaryKey = 'id_ba';
    public $timestamps = false;

    protected $fillable = [
        'tanggal_ba',
        'referensi',
        'id_unit',
        'diketahui',
        'menyetujui',
        'penerima',
        'jabatan_penerima',
        'kode_barcode',
        'lampiran'
    ];

    protected $casts = [
        'lampiran' => 'array',
    ];    

    public function unit()
    {
        return $this->belongsTo(MasterUnit::class, 'id_unit', 'id_unit');
    }

    public function atkKeluar()
    {
        return $this->hasMany(AtkKeluar::class, 'id_ba', 'id_ba');
    }
}