<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class estadoModel extends Model
{
    protected $table="estados";
    protected $fillable=["nb_estado","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function direcciones(){
        return $this->hasMany(direccionesModel::class,'estado_id');
    }

    public function ciudades(){
        return $this->hasMany(ciudadesModel::class,'estado_id');
    }

    public function municipio(){
        return $this->hasMany(municipiosModel::class,'estado_id');
    }

    
    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }



}
