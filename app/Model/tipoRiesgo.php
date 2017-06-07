<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tipoRiesgo extends Model
{
    protected $table="tipo_riesgo";
    protected $fillable=["nb_tipo_riesgo","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function datosRiesgoAsegurable(){
        return $this->belongsTo(datosRiesgoAsegurable::class,"tipo_riesgo_id");
    }

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
}
