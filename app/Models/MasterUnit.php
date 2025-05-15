<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterUnit extends Model
{
    protected $table = 'master_unit';
    protected $primaryKey = 'id_unit';
    public $timestamps = false;

    protected $fillable = [
        'nama_unit'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_unit', 'id_unit');
    }

    public function atkKeluar()
    {
        return $this->hasMany(AtkKeluar::class, 'id_unit', 'id_unit');
    }

    public function beritaAcara()
    {
        return $this->hasMany(BeritaAcara::class, 'id_unit', 'id_unit');
    }
}