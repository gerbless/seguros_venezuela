<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class agentesCampanasModel extends Model
{
    protected $table="campana";
    protected $fillable=["user_id","campana_id","status_id"];


    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function campanas()
    {
        return $this->belongsTo(statusModel::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class,"user_id");
    }

    public function campana()
    {
        return $this->belongsTo(campanaModel::class,"campana_id");
    }
    
    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
    
    
}
