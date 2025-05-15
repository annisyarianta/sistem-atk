<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValidasiAtk extends Model
{
    protected $table = 'validasi_atk';
    protected $primaryKey = 'id_validasi';
    public $timestamps = false;

    protected $fillable = [
        'id_request'
    ];

    // Relasi ke request_atk
    public function requestAtk()
    {
        return $this->belongsTo(RequestAtk::class, 'id_request', 'id_request');
    }
}