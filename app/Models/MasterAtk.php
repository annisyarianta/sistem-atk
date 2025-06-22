<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterAtk extends Model
{
    protected $table = 'master_atk';
    protected $primaryKey = 'id_atk';
    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'id_atk';
    }
    
    protected $fillable = [
        'nama_atk',
        'kode_atk',
        'jenis_atk',
        'satuan',
        'jumlah_minimum',
        'gambar_atk',
    ];

    public function atkMasuk()
    {
        return $this->hasMany(AtkMasuk::class, 'id_atk', 'id_atk');
    }

    public function atkKeluar()
    {
        return $this->hasMany(AtkKeluar::class, 'id_atk', 'id_atk');
    }

    public function requestAtk()
    {
        return $this->hasMany(RequestAtk::class, 'id_atk', 'id_atk');
    }

    public function getGambar()
    {
        if (!$this->gambar_atk) {
            return asset('build/assets/img/logo-injourney-airport.png');
        }

        return asset('images/' . $this->gambar_atk);
    }
}
