<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class paisModel extends Model
{
    protected $table="paises";
    protected $fillable=["nb_pais","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function direcciones(){
        return $this->hasMany(direccionesModel::class,'pais_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
}

