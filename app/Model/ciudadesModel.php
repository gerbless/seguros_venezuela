<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ciudadesModel extends Model
{
    protected $table="ciudades";
    protected $fillable=["nb_ciudad","estato_id","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function estados(){
        return $this->belongsTo(estadoModel::class,"estado_id");
    }

    public function direcciones(){
        return $this->hasMany(direccionesModel::class,'ciudad_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }

}
