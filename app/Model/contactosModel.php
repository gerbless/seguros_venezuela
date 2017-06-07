<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class contactosModel extends Model
{
    protected $table="contactos";
    protected $fillable=["status_id","clientes_id","tpfnivel1_id","tpfnivel2_id","tpfnivel3_id","tpfnivel4_id","users_id","telefono","comentario"];

    public function status(){
        return $this->belongsTo(statusModel::class,"status_id");
    }

    public function clientes(){
        return $this->belongsTo(clientesModel::class,"clientes_id");
    }

    public function tpfnivel1(){
        return $this->belongsTo(tpfnivel1Model::class,"tpfnivel1_id");
    }

    public function tpfnivel2(){
        return $this->belongsTo(tpfnivel2Model::class,"tpfnivel2_id");
    }

    public function tpfnivel3(){
        return $this->belongsTo(tpfnivel3Model::class,"tpfnivel3_id");
    }

    public function tpfnivel4(){
        return $this->belongsTo(tpfnivel4Model::class,"tpfnivel4_id");
    }

    public function users(){
        return $this->belongsTo(User::class);
    }
    
    
    public  function setTpfnivel2IdAttribute($tpfnivel2_id)
    {
        if($tpfnivel2_id =="")
        {
            $this->attributes['tpfnivel2_id']=null;
        }else{
            $this->attributes['tpfnivel2_id']=$tpfnivel2_id;
        }

    }
    public  function setTpfnivel3IdAttribute($tpfnivel3_id)
    {
        if($tpfnivel3_id=="")
        {
            $this->attributes['tpfnivel3_id']=null;
        }else{
            $this->attributes['tpfnivel3_id']=$tpfnivel3_id;
        }
    }
    public  function setTpfnivel4IdAttribute($tpfnivel4_id)
    {
        if($tpfnivel4_id=="")
        {
            $this->attributes['tpfnivel4_id']=null;
        }else{
            $this->attributes['tpfnivel4_id']=$tpfnivel4_id;
        }
    }


}
