<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtkKeluar extends Model
{
    protected $table = 'atkkeluar';
    protected $primaryKey = 'id_keluar';
    public $timestamps = false;

    protected $fillable = [
        'id_atk',
        'jumlah_keluar',
        'tanggal_keluar',
        'id_unit'
    ];

    public function masterAtk()
    {
        return $this->belongsTo(MasterAtk::class, 'id_atk', 'id_atk');
    }

    public function unit()
    {
        return $this->belongsTo(MasterUnit::class, 'id_unit', 'id_unit');
    }
}