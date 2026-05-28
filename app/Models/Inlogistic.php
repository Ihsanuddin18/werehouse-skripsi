<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Outlogistic;
use App\Models\Logistic;
use App\Models\Supplier;
use App\Models\LogisticRequest;


class Inlogistic extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'id_logistik',
        'id_supplier',
        'jumlah_logistik_masuk',
        'tanggal_masuk',
        'expayer_logistik',
        'keterangan_masuk',
        'dokumentasi_masuk',
    ];

    public function logistic()
    {
        return $this->belongsTo(Logistic::class, 'id_logistik', 'id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id');
    }
    public function outlogistics()
    {
        return $this->hasMany(Outlogistic::class, 'id_inlogistik');
    }
    public function logisticrequest()
    {
        return $this->hasMany(LogisticRequest::class, 'id_inlogistik');
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
