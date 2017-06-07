<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class beneficiariosModel extends Model
{
    protected $table="beneficiarios";
    protected $fillable=[
        "clientes_id",
        "status_id",
        "heredero_id",
        "tipo_persona_id",
        "nacionalidad_id",
        "nu_documento",
        "nb_nombre",
        "nb_apellido",
        "ff_nacimiento",
        "edad",
        "parentesco_id",
        "tipobeneficiario_id",
        "ff_registro",
        "ff_ultima_actualizacion",
        "poliza_asegurado_id"
    ];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function polizaAsegurados(){
       return $this->belongsTo(PolizaAseguradosModel::class,"poliza_asegurado_id");
    }

    public function tipoBeneficiario()
    {
        return$this->belongsTo(tipoBeneficiario::class,"tipobeneficiario_id");
    }

    public function parentesco()
    {
        return $this->belongsTo(parentescoModel::class,"parentesco_id");
    }

    public function nacionalidad()
    {
        return$this->belongsTo(nacionalidadModel::class);
    }

    public function tipoPersona()
    {
        return $this->belongsTo(tipoPersonaModel::class,"tipo_persona_id");
    }

    public function herederos()
    {
        return $this->belongsTo(herederosLegalesModel::class);
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
