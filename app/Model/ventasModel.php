<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ventasModel extends Model
{
    protected $table="ventas";
    protected $fillable=["tarifario_id",
        "poliza_pagador_id",
        "users_id",
        "monto",
        "total",
        "nu_asegurados",
        "reporte_poliza",
        "status_id"];

    public function asegurados(){
        return $this->belongsTo(PolizaAseguradosModel::class,"poliza_pagador_id");
    }

    public function tarifario(){
        return $this->belongsTo(tarifarioModel::class,"tarifario_id");
    }

    public function users(){
        return $this->belongsTo(User::class,"users_id");
    }
    
    public function status(){
        return $this->belongsTo(statusModel::class);
    }
    
    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
}
