<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestAtk extends Model
{
    protected $table = 'request_atk';
    protected $primaryKey = 'id_request';
    public $timestamps = false;

    protected $fillable = [
        'id_atk',
        'tanggal_request',
        'jumlah_request',
        'id_user',
        'status'
    ];

    // Relasi ke master_atk
    public function masterAtk()
    {
        return $this->belongsTo(MasterAtk::class, 'id_atk', 'id_atk');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function validasi()
    {
        return $this->hasOne(ValidasiAtk::class, 'id_request', 'id_request');
    }
}