<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class toquesTelefonoModel extends Model
{
    protected $table="toques_telefono";
    protected $fillable=["status_id","toques","id","clientes_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function clientes(){
        return $this->belongsTo(clientesModel::class);
    }


}
