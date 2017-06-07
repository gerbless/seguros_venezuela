<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class productosModel extends Model
{
    protected $table="productos";
    protected $fillable=["nb_producto","id","ramo_id","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }
    
    public function ramos(){
        return $this->belongsTo(ramosModel::class,"ramo_id");
    }

    public function planes(){
        return $this->hasMany(planesModel::class,"producto_id");
    }
    
    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
}
