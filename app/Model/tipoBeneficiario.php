<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tipoBeneficiario extends Model
{
    protected $table="tipo_beneficiario";
    protected $fillable=["id","nb_tipo_beneficiario","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }

    public function beneficiarios(){
        return $this->hasMany(beneficiariosModel::class);
    }
}
