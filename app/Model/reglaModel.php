<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class reglaModel extends Model
{
    protected $table="reglas";
    protected $fillable=["status_id","tpfnivel1_id","tpfnivel2_id","tpfnivel3_id","tpfnivel4_id","tpfnivel4_id","cierre"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function tpfnivel1(){
        return $this->belongsTo(tpfnivel1Model::class);
    }

    public function tpfnivel2(){
        return $this->belongsTo(tpfnivel2Model::class);
    }

    public function tpfnivel3(){
        return $this->belongsTo(tpfnivel3Model::class);
    }

    public function tpfnivel4(){
        return $this->belongsTo(tpfnivel4Model::class);
    }

}
