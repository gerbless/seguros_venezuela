<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tipoPersonaModel extends Model
{
    protected $table="tipo_persona";
    protected $fillable=["nb_persona","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function polizaPagador(){
        return $this->hasMany(polizaPagadorModel::class,'tipo_persona_id');
    }

    public function tomadorPoliza(){
        return $this->hasMany(tomadorPolizaModel::class,'nacionalidad_id');
    }

    public function beneficiarios(){
        return $this->hasMany(beneficiariosModel::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }

}
