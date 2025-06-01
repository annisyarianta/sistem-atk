<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    /**
     * Nama tabel yang digunakan.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Primary key dari tabel.
     *
     * @var string
     */
    protected $primaryKey = 'id_user';
    public $incrementing = true; 
    protected $keyType = 'int';

    /**
     * Aktifkan timestamps.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'email_verified_at',
        'remember_token',
        'created_at',
        'updated_at',
        'id_unit'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function unit()
    {
        return $this->belongsTo(MasterUnit::class, 'id_unit', 'id_unit');
    }

    public function requestAtk()
    {
        return $this->hasMany(RequestAtk::class, 'id_user', 'id_user');
    }

    public function logins()
    {
        return $this->hasMany(LogLogin::class, 'id_user', 'id_user');
    }

    public function activities()
    {
        return $this->hasMany(LogActivity::class, 'id_user', 'id_user');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isStaff()
    {
        return $this->role === 'staff';
    }
}
