<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class mediosPagoModel extends Model
{
    protected $table="medios_pago";
    protected $fillable=["nb_medio_pago","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function polizaPagador(){
        return $this->hasMany(polizaPagadorModel::class,"medio_pago_id");
    }

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
}
