<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class coberturasModel extends Model
{
    protected $table="coberturas";
    protected $fillable=["id","plan_id","cod_cml","caso_muerte","nb_cobertura","suma_asegurada","suma_asegurada","prima","tasa","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function planes(){
        return $this->belongsTo(planesModel::class,"plan_id");
    }

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }

  /*  public  function setCodCmlAttribute($id)
    {
        $this->attributes['cod_cml']= $id;
        $num=coberturasModel::all()->count();
        $this->attributes['id']=++$num;
    }*/

    public  function setPrimaAttribute($prima)
    {
        $this->attributes['prima']= str_replace(',',".",$prima);
    }

    public  function setTasaAttribute($tasa)
    {
        $this->attributes['tasa']=str_replace(',',".",$tasa);

    }

}
