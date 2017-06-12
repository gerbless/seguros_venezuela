<?php

namespace App\Model;

use App\Providers\EventServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

class tarifarioModel extends Model
{
    protected $table="tarifario";
    protected $fillable=["campana_id","ramo_id","producto_id","plan_id","frecuencia_pago_id","prima","suma_total_asegurados","aplica_rango","rangoedad_id","status_id"];

    public function campanas(){
        return $this->belongsTo(campanaModel::class,"campana_id");
    }

    public function ramos(){
        return $this->belongsTo(ramosModel::class,"ramo_id");
    }

    public function productos(){
        return $this->belongsTo(productosModel::class,"producto_id");
    }

    public function planes(){
        return $this->belongsTo(planesModel::class,"plan_id");
    }

    public function frecuencia(){
        return $this->belongsTo(frecuenciaPagoModel::class,"frecuencia_pago_id");
    }

    public function status(){
        return $this->belongsTo(statusModel::class,"status_id");
    }

    public function rangoedad(){
        return $this->belongsTo(rangoEdadModel::class,'rangoedad_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status_id',1);
    }
    

}
