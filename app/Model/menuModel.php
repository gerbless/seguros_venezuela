<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class menuModel extends Model
{
    protected $table="menu";
    protected $fillable=["status_id","nombre","orden"];


    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function submenu(){
        return $this->hasMany(submenuModel::class,'menu_id');
    }
}
