<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class planesModel extends Model
{
    protected $table="planes";
    protected $fillable=["id","producto_id","nb_plan","cod_xml","status_id"];

    public  function setIdAttribute($id)
    {
        $this->attributes['cod_xml']= $id;
        $num=planesModel::all()->count();
        $this->attributes['id']=++$num;
    }

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function producto(){
        return $this->belongsTo(productosModel::class,"producto_id");
    }

    public function coberturas(){
        return $this->hasMany(coberturasModel::class,"plan_id");
    }


    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
}
