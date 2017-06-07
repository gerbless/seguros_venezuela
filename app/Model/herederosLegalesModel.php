<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class herederosLegalesModel extends Model
{
    protected $table="herederos_legales";
    protected $fillable=[
        "id",
        "nb_heredero",
        "status_id"
    ];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function beneficiarios(){
        return $this->hasMany(beneficiariosModel::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
}
