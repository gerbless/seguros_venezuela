<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class rangoEdadModel extends Model
{
    protected $table="rango_edad";
    protected $fillable=["minimo","maximo","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function tarifario(){
        return $this->hasOne(tarifarioModel::class,'rangoedad_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
}
