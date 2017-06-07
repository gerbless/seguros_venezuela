<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class nacionalidadModel extends Model
{
    protected $table="nacionalidad";
    protected $fillable=["nb_nacionalidad","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function polizaPagador(){
        return $this->hasMany(polizaPagadorModel::class,'nacionalidad_id');
    }

    public function tomadorPoliza(){
        return $this->hasMany(tomadorPolizaModel::class,'nacionalidad_id');
    }

    public function beneficiarios(){
        return $this->hasMany(beneficiariosModel::class);
    }

    public function datosRiesgoAsegurables(){
        return $this->hasMany(datosRiesgoAsegurable::class,"nacionalidad_id");
    }

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }

    public function scopeNacional($query)
    {
        return $query->where('id',"<>","N");
    }
}
