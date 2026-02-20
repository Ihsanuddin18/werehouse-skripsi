<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Logistic;
use App\Models\Inlogistic;

class Outlogistic extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_logistik',
        'jumlah_logistik_keluar',
        'tanggal_keluar',
        'nama_penerima',
        'nik_kk_penerima',
        'alamat_penerima',
        'keterangan_keluar',
        'dokumentasi_keluar',
    ];

    public function logistic()
    {
        return $this->belongsTo(Logistic::class, 'id_logistik', 'id');
    }
    
    public function inlogistic()
    {
        return $this->belongsTo(Inlogistic::class, 'id_inlogistik');
    }

     public function logisticrequests()
    {
        return $this->hasMany(LogisticRequest::class, 'id_outlogistik', 'id');
    }
}
