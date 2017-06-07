<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class agenciasModel extends Model
{
    protected $table="agencias";
    protected $fillable=["nb_tipo_beneficiario","id","status_id"];

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }

    public function status(){
        return $this->belongsTo(statusModel::class,'status_id');
    }
}
