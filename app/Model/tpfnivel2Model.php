<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tpfnivel2Model extends Model
{
    protected $table="tpfnivel2";
    protected $fillable=["status_id","tpfnivel1_id","nb_tpfnivel2","orden"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function contactos(){
        return $this->hasMany(contactosModel::class);
    }

    public function tpfnivel1(){
        return $this->belongsTo(tpfnivel1Model::class);
    }

    public function tpfnivel3(){
        return $this->hasMany(tpfnivel3Model::class,'tpfnivel2_id');
    }

    public function aperturas(){
        return $this->hasMany(aperturasModel::class);
    }

    public function regla(){
        return $this->hasMany(reglaModel::class);
    }


    public function scopeValor($query,$valor)
    {
        return $query->where("id",$valor);
    }
    
}
