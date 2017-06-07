<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class nivelEducativoModel extends Model
{
    protected $table="nivel_educativo";
    protected $fillable=["nb_nivel_educativo","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function polizaAsegurados(){
        return $this->hasMany(polizaAseguradosModel::class,'nivel_educativo_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
}
