<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class actividadEconomicaCivilModel extends Model
{
    protected $table="activida_economica";
    protected $fillable=["status_id","nb_actividad_economica"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
}
