<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class bacosModel extends Model
{
    protected $table="bancos";
    protected $fillable=["id","tipo_banco","nb_banco","nacionalidad","status_id", "codigo"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function tomadorPoliza(){
        return $this->belongsTo(tomadorPolizaModel::class,"banco_id");
    }

    public function polizaPagador(){
        return $this->belongsTo(polizaPagadorModel::class,"banco_id");
    }
    
    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
}
