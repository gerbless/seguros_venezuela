<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class submenuModel extends Model
{
    protected $table="submenu";
    protected $fillable=["status_id","menu_id","nombre","ruta","orden"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function menu(){
        return $this->belongsTo(menuModel::class,'menu_id');
    }
}
