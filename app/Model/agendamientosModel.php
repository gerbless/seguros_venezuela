<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class agendamientosModel extends Model
{
    protected $table="agendamientos";
    protected $fillable=["status_id","id","nro","ff_agendado","hh_agendado","ff_hh_agendado","clientes_id","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function clientes(){
        return $this->belongsTo(clientesModel::class,"clientes_id");
    }

    public  function setFfAgendadoAttribute($ff_agendado)
    {
        $this->attributes['ff_agendado']= date('Y-m-d',strtotime($ff_agendado));
    }

    public  function setHhAgendadoAttribute($hh_agendado)
    {
        $this->attributes['hh_agendado']= date('H:i:s',strtotime($hh_agendado));

        $this->attributes['ff_hh_agendado']=date('Y-m-d',strtotime($this->attributes['ff_agendado']))." ".date('H:i:s',strtotime($this->attributes['hh_agendado']));
    }




}
