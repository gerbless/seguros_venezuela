<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tomadorPolizaModel extends Model
{
    protected $table="tomador_poliza";
    protected $fillable=["nb_nombre","banco_id","clientes_id","nacionalidad_id","nu_documento","direccion_id","ff_registro","tipo_persona_id","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function nacionalidades(){
        return $this->belongsTo(nacionalidadModel::class,'nacionalidad_id');
    }

    public function direcciones(){
        return $this->belongsTo(direccionesModel::class,'direccion_id');
    }

    public function tipoPersona(){
        return $this->belongsTo(tipoPersonaModel::class,'tipo_persona_id');
    }

    public function clientes(){
        return $this->belongsTo(clientesModel::class,"clientes_id");
    }

    public function bancos(){
        return $this->belongsTo(bacosModel::class,"banco_id");
    }


    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
}
