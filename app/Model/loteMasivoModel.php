<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
class loteMasivoModel extends Model
{
    protected $table="lote_masivo";
    protected $fillable=["id","name","cantidad_datos","status_id"];

    public function clientes(){
        return $this->hasMany(clientesModel::class,'lote_id');
    }

    public static function insertlote($name, $cantidad){
        $fecha = Carbon::now();
      return  loteMasivoModel::insertGetId(
            [
                'name'=> $name, 
                'cantidad_datos'=> $cantidad,
                'status_id'=> 1,
                'created_at'=> $fecha,
                'updated_at'=> $fecha
            ]
        );
    }
}
