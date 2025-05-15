<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogLogin extends Model
{
    protected $table = 'log_login';
    protected $primaryKey = 'id_loglogin';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'waktu_login'
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}