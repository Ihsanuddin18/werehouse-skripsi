<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Logistic;
use App\Models\Inlogistic;
use App\Models\User;

class LogisticRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_logistik',
        'id_inlogistik',
        'id_outlogistik', 
        'stok_saat_ini', 
        'rata_bulanan',
        'rekomendasi_tahunan',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function logistic()
    {
        return $this->belongsTo(Logistic::class, 'id_logistik', 'id');
    }
    
    public function inlogistic()
    {
        return $this->belongsTo(Inlogistic::class, 'id_inlogistik');
    }
    
    public function outlogistic()
    {
        return $this->belongsTo(Outlogistic::class, 'id_outlogistik');
    }

}
