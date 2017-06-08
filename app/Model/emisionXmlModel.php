<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class emisionXmlModel extends Model
{
    protected $table="emision_xml";
    protected $fillable=["users_id","desde","hasta","claves","status_id"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function users(){
        return $this->belongsTo(User::class,"users_id");
    }
    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
    
}
