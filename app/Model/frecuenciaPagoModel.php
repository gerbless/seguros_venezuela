<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class frecuenciaPagoModel extends Model
{
    protected $table="frecuencia_pago";
    protected $fillable=["id","nb_frecuencia_pago","multiplicar","cod_xml","status_id"];
    public  function setCodXmlAttribute($id)
    {
        $this->attributes['cod_xml']= $id;
        $num=frecuenciaPagoModel::all()->count();
        $this->attributes['id']=++$num;
    }
    public function status(){
        return $this->belongsTo(statusModel::class,"status_id");
    }
    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
}
