<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class emisionXmlModel extends Model
{
    protected $table="emision_xml";
    protected $fillable=["users_id","desde","hasta","claves","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }
    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
    
}
