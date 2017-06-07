<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class direccionesModel extends Model
{
    protected $table="direcciones";
    protected $fillable=["pais_id","estado_id","ciudad_id","municipio_id","nb_parroquia","co_postal","tx_avenida_calle","tx_urbanizacion_direccion","nb_edificio_casa","nu_piso","nu_casa","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function paises(){
        return $this->belongsTo(paisModel::class);
    }

    public function estados(){
        return $this->belongsTo(estadoModel::class);
    }

    public function ciudades(){
        return $this->belongsTo(ciudadesModel::class);
    }

    public function municipios(){
        return $this->belongsTo(municipiosModel::class);
    }

    public function polizaPagador(){
        return $this->hasMany(polizaPagadorModel::class,'direccion_id');
    }

    public function tomadorPoliza(){
        return $this->hasMany(tomadorPolizaModel::class,'nacionalidad_id');
    }
}
