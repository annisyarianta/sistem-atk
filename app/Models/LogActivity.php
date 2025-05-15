<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    protected $table = 'log_activity';
    protected $primaryKey = 'id_logactivity';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'waktu_aktivitas',
        'aksi',
        'jenis_data',
        'keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}