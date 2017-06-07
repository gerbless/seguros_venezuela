<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tpfnivel4Model extends Model
{
    protected $table="tpfnivel4";
    protected $fillable=["status_id","tpfnivel3_id","nb_tpfnivel4","orden"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function contactos(){
        return $this->hasMany(contactosModel::class);
    }

    public function tpfnivel3(){
        return $this->belongsTo(tpfnivel3Model::class);
    }

    public function aperturas(){
        return $this->hasMany(aperturasModel::class);
    }

    public function regla(){
        return $this->hasMany(reglaModel::class);
    }
}
