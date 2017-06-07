<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class sexosModel extends Model
{
    protected $table="sexos";
    protected $fillable=["id","nb_sexo","status_id"];


    public function status(){
        return $this->belongsTo(statusModel::class);
    }
    public function afiliados(){
        return $this->hasMany(afiliadosModel::class);
    }

    public function contratantes(){
        return $this->hasMany(contratantesModel::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
}
