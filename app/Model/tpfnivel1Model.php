<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tpfnivel1Model extends Model
{
    protected $table="tpfnivel1";
    protected $fillable=["status_id","nb_tpfnivel1","orden"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function contactos(){
        return $this->hasMany(contactosModel::class);
    }

    public function tpfnivel2(){
        return $this->hasMany(tpfnivel2Model::class,'tpfnivel1_id');
    }

    public function aperturas(){
        return $this->hasMany(aperturasModel::class);
    }

    public function regla(){
        return $this->hasMany(reglaModel::class);
    }
}
