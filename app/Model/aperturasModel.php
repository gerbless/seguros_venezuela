<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class aperturasModel extends Model
{
    protected $table="aperturas";
    protected $fillable=["status_id","tpfnivel1_id","tpfnivel2_id","tpfnivel3_id","tpfnivel4_id"];

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
