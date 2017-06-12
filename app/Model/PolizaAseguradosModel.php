<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PolizaAseguradosModel extends Model
{
    protected $table="poliza_asegurados";
    protected $fillable=[
        "cliente_id",
        "nb_nombre",
        "nacionalidad_id",
        "nu_documento",
        "direccion_id",
        "ff_registro",
        "tipo_persona_id",
        "nb_apellido",
        "ff_ultima_actualizacion",
        "nivel_educativo_id",
        "ocupacion_id",
        "ff_nacimiento",
        "sexo_id",
        "estadocivil_id",
        "nu_hijos",
        "email",
        "nu_tlf_hogar",
        "nu_tlf_celular",
        "nb_empresa",
        "nb_cargo",
        "nu_ingresos",
        "nu_tlf_oficina1",
        "nu_tlf_oficina2",
        "activida_economica_id",
        "nu_capital_promedio",
        "tarifario_id",
        "edad",
        "status_id"
    ];


    public function status(){
        return $this->belongsTo(statusModel::class);
    }


    public function tarifario(){
        return $this->belongsTo(tarifarioModel::class,"tarifario_id");
    }


    public function clientes(){
        return $this->belongsTo(clientesModel::class,"cliente_id");
    }

    public function nacionalidad()
    {
        return $this->belongsTo(nacionalidadModel::class,"nacionalidad_id");
    }

    public function direccion()
    {
        return $this->belongsTo(direccionesModel::class,"direccion_id");
    }

    public function tipoPersona()
    {
        return $this->belongsTo(tipoPersonaModel::class,"tipo_persona_id");
    }

    public function nivelEducativo()
    {
        return $this->belongsTo(nivelEducativoModel::class,"nivel_educativo_id");
    }

    public function ocupacion()
    {
        return $this->belongsTo(OcupacionModel::class,"ocupacion_id");
    }

    public function estadoCivil()
    {
        return $this->belongsTo(estadoCivilModel::class,"nivel_educativo_id");
    }

    public function sexo()
    {
        return $this->belongsTo(sexosModel::class,"sexo_id");
    }

    public function actividadEconomica()
    {
        return $this->belongsTo(actividadEconomicaCivilModel::class,"activida_economica_id");
    }

    public function beneficiarios()
    {
        return $this->hasMany(beneficiariosModel::class,"poliza_asegurado_id");
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
        $this->attributes['ff_ultima_actualizacion']= date('Y-m-d');
    }

    
    
    

   /* public  function setNuIngresosAttribute($nu_ingresos)
    {
        $this->attributes['nu_ingresos']= str_replace(',','.',$nu_ingresos);
    }*/

    /*public  function setNuCapitalPromedioAttribute($nu_capital_promedio)
    {
        $this->attributes['nu_capital_promedio']= str_replace(',','.',$nu_capital_promedio);
    }*/
}


