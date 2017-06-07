<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class toquesModel extends Model
{
    protected $table="toques";
    protected $fillable=["status_id","max_toques"];

    public function status(){
        return $this->belongsTo(statusModel::class);
    }
}
