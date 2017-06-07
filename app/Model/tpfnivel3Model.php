<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tpfnivel3Model extends Model
{
    protected $table="tpfnivel3";
    protected $fillable=["status_id","tpfnivel2_id","nb_tpfnivel3","orden"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function contactos(){
        return $this->hasMany(contactosModel::class);
    }

    public function tpfnivel2(){
        return $this->belongsTo(tpfnivel2Model::class);
    }

    public function tpfnivel4(){
        return $this->hasMany(tpfnivel4Model::class,'tpfnivel3_id');
    }

    public function aperturas(){
        return $this->hasMany(aperturasModel::class);
    }

    public function regla(){
        return $this->hasMany(reglaModel::class);
    }
}
