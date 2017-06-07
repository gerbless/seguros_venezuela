<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class clientesModel extends Model
{
    protected $table="clientes";
    protected $fillable=[
        "users_id",
        "lote_id",
        "cliente",
        "nacionalidad",
        "documento",
        "direccion",
        "telefono1",
        "telefono2",
        "telefono4",
        "telefono5",
        "telefono3",
        "correo",
        "sexo",
        "edo_civil",
        "edad",
        "plan",
        "campana",
        "ramo",
        "producto",
        "sponsor_id",
        "status_id"

    ];

    public function lotes()
    {
        return $this->belongsTo(loteMasivoModel::class,'lote_id');
    }
    public function sponsor(){
        return $this->belongsTo(sponsorModel::class,'sponsor_id');
    }
    
    public function status(){
        return $this->belongsTo(statusModel::class,'status_id');
    }

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function contactos(){
        return $this->hasMany(contactosModel::class,'clientes_id');
    }
    
    public function toquesTelefono(){
        return $this->hasMany(toquesTelefonoModel::class,'clientes_id');
    }
    
    public function agendamientos(){
        return $this->hasMany(agendamientosModel::class,'clientes_id');
    }

    public function polizaPagador(){
        return $this->hasMany(polizaPagadorModel::class,'clientes_id');
    }

    public function tomadorPoliza(){
        return $this->hasMany(tomadorPolizaModel::class,'clientes_id');
    }

    public function datosRiesgoAsegurables(){
        return $this->hasMany(datosRiesgoAsegurable::class,"clientes_id");
    }

    public static function insertcliente($nombre,$ci,$telefono1, $telefono2,$correo,$sponsor,$lote,$nacionalidad,$sexo,$edo_civil,$plan,$edad,$campana,$ramo,$producto){
     clientesModel::insert(
            [
                'cliente' => $nombre,
                'documento' => $ci,
                'telefono1' => $telefono1,
                'telefono2' => $telefono2,
                'correo' => $correo,
                'sponsor_id' => $sponsor,
                'status_id' => '0',
                'lote_id' => $lote,
                'created_at' => date('Y-m-d'),
                'nacionalidad'=>$nacionalidad,
                'sexo'=>$sexo,
                'edo_civil'=>$edo_civil,
                'plan'=>$plan,
                'edad'=>$edad,
                'campana'=>$campana,
                'ramo'=>$ramo,
                'producto'=>$producto
            ]
        );
    }

    public function scopeLote($query,$id){
        if($id != ""){
            $query->where('lote_id', $id);
        }

    }
}
