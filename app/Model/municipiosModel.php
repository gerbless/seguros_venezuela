<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class municipiosModel extends Model
{
    protected $table="municipios";
    protected $fillable=["nb_municipio","estado_id","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function estados(){
        return $this->belongsTo(estadoModel::class,"estado_id");
    }

    public function direcciones(){
        return $this->hasMany(direccionesModel::class,'municipio_id');
    }
}
