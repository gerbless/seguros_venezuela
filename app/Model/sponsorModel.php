<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class sponsorModel extends Model
{
    protected $table="sponsor";
    protected $fillable=["nb_sponsor","id"];
    
    public function clientes(){
        return $this->hasMany(clientesModel::class,'sponsor_id');
    }
}
