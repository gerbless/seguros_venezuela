<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class reglaModel extends Model
{
    protected $table="reglas";
    protected $fillable=["status_id","tpfnivel1_id","tpfnivel2_id","tpfnivel3_id","tpfnivel4_id","cierre"];

    public function status(){
        return $this->belongsTo(statusModel::class,"status_id");
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

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }

    public function scopeDective($query)
    {
        return $query->where('status_id','<>',2);
    }

}
