<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class campanaModel extends Model
{
    protected $table="campana";
    protected $fillable=["nb_campana","status_id","id"];

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }

    public function agentescampanas(){
        return $this->hasMany(agentesCampanasModel::class,'campana_id');
    }

    public function ramos(){
        return $this->hasMany(ramosModel::class,'campana_id');
    }

    public function status(){
        return $this->belongsTo(statusModel::class,'status_id');
    }
}
