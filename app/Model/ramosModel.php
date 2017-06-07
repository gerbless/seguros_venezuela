<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ramosModel extends Model
{
    protected $table="ramos";
    protected $fillable=["campana_id","nb_ramo","id","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function campana(){
        return $this->belongsTo(campanaModel::class,"campana_id");
    }

    public function productos(){
        return $this->hasMany(productosModel::class,"ramo_id");
    }

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
}
