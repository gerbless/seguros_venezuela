<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class rolesModel extends Model
{
    protected $table="roles";
    protected $fillable=["status_id","user_id","submenu_id"];


    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function submenu(){
        return $this->belongsTo(submenuModel::class,'submenu_id');
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
}
