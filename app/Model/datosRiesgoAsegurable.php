<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class datosRiesgoAsegurable extends Model
{
    protected $table="datos_riesgo_asegurables";
    protected $fillable=[
        "clientes_id",
        "tipo_riesgo_id",
        "nacionalidad_id",
        "nu_documento",
        "nb_nombre",
        "nb_apellido",
        "ff_nacimiento",
        "edad",
        "parentesco_id",
        "ff_registro",
        "ff_ultima_actualizacion",
        "status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function tipoRiesgo(){
        return $this->belongsTo(tipoRiesgo::class,"tipo_riesgo_id");
    }

    public function nacionalidad(){
        return $this->belongsTo(nacionalidadModel::class,"nacionalidad_id");
    }

    public function parentesco(){
        return $this->belongsTo(parentescoModel::class,"parentesco_id");
    }

    public function clientes(){
        return $this->belongsTo(clientesModel::class,"clientes_id");
    }

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }

    public  function setFfNacimientoAttribute($ff_nacimiento)
    {
        $this->attributes['ff_nacimiento']= date('Y-m-d',strtotime($ff_nacimiento));
    }

    public  function setFfRegistroAttribute()
    {
        $this->attributes['ff_registro']= date('Y-m-d');
    }

    public  function setFfUltimaActualizacionAttribute()
    {
        $this->attributes['ff_ultima_actualizacion']= date('Y-m-d');
    }
}
