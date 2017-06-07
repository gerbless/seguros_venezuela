<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class parentescoModel extends Model
{
    protected $table="parentesco";
    protected $fillable=[
        "status_id",
        "nb_parentesco",
        "cod_xml"
    ];

    public  function setCodXmlAttribute($id)
    {
        $this->attributes['cod_xml']= $id;
        $num=parentescoModel::all()->count();
        $this->attributes['id']=++$num;
    }

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

    public function datosRiesgoAsegurables(){
        return $this->hasMany(datosRiesgoAsegurable::class,"parentesco_id");
    }
}
