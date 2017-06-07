<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OcupacionModel extends Model
{
    protected $table="ocupacion";
    protected $fillable=["nb_ocupacion","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class,"status_id");
    }

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
}
