<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtkMasuk extends Model
{
    protected $table = 'atkmasuk';
    protected $primaryKey = 'id_masuk';
    public $timestamps = false;

    protected $fillable = [
        'id_atk',
        'jumlah_masuk',
        'tanggal_masuk',
        'harga_satuan',
        'harga_total'
    ];

    public function masterAtk()
    {
        return $this->belongsTo(MasterAtk::class, 'id_atk', 'id_atk');
    }
}