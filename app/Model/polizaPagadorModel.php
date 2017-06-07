<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class polizaPagadorModel extends Model
{
    protected $table = "poliza_pagador";
    protected $fillable = ["id",
        "clientes_id",
        "banco_id",
        "nb_nombre",
        "nacionalidad_id",
        "nu_documento",
        "direccion_id",
        "ff_registro",
        "tipo_persona_id",
        "medio_pago_id",
        "nu_medio_pago",
        "tipo_transaccion",
        "operador_id",
        "canal_id",
        "campana_id",
        "ramo_id",
        "producto_id",
        "plan_id",
        "frecuencia_pago_id",
        "sucursal_id",
        "userbanco",
        "userproveedor",
        "tipo_moneda_id",
        "status_id",
        "nb_apellido",
        "ff_ultima_actualizacion",
        "nivel_educativo_id",
        "ocupacion_id",
        "ff_nacimiento",
        "sexo_id",
        "estadocivil_id",
        "nu_hijos",
        "email",
        "nu_tlf_hogar",
        "nu_tlf_celular",
        "nb_empresa",
        "nb_cargo",
        "nu_ingresos",
        "nu_tlf_oficina1",
        "nu_tlf_oficina2",
        "activida_economica_id",
        "prima",
        "nu_capital_promedio"];


    public function frecuencia()
    {
        return $this->belongsTo(frecuenciaPagoModel::class, 'frecuencia_pago_id');
    }

    public function campana()
    {
        return $this->belongsTo(campanaModel::class, 'campana_id');
    }

    public function status(){
        return $this->belongsTo(statusModel::class);
    }

    public function nacionalidades()
    {
        return $this->belongsTo(nacionalidadModel::class, 'nacionalidad_id');
    }

    public function direcciones()
    {
        return $this->belongsTo(direccionesModel::class, 'direccion_id');
    }

    public function tipoPersona()
    {
        return $this->belongsTo(tipoPersonaModel::class, 'tipo_persona_id');
    }

    public function clientes()
    {
        return $this->belongsTo(clientesModel::class, "clientes_id");
    }

    public function mediopago()
    {
        return $this->belongsTo(mediosPagoModel::class, "medio_pago_id");
    }

    public function bancos()
    {
        return $this->belongsTo(bacosModel::class, "banco_id");
    }

    public function plan()
    {
        return $this->belongsTo(planesModel::class, "plan_id");
    }

    public function cliente()
    {
        return $this->belongsTo(clientesModel::class, "clientes_id");
    }

    public function ramo()
    {
        return $this->belongsTo(ramosModel::class, "ramo_id");
    }

    public function producto()
    {
        return $this->belongsTo(productosModel::class, "producto_id");
    }



    public function setFfNacimientoAttribute($ff_nacimiento)
    {
        $this->attributes['ff_nacimiento'] = date('Y-m-d', strtotime($ff_nacimiento));
    }

    public function setFfRegistroAttribute()
    {
        $this->attributes['ff_registro'] = date('Y-m-d');
        $this->attributes['ff_ultima_actualizacion'] = date('Y-m-d');
    }


    public function scopeActive($query)
    {
        return $query->where('status_id', 1);
    }

    public function scopeTipo($query, $valor, $campana)
    {
        if ($valor == "VENTA")
        {
            $query->whereNotNull('prima')
                ->where('poliza_pagador.campana_id', $campana)
                ->otras()
                ->select(

                    'campana.nb_campana as CAMPANA',
                    'ramos.nb_ramo AS RAMO',
                    'productos.nb_producto AS PRODUCTO',
                    'planes.nb_plan AS PLAN',
                    'poliza_pagador.nacionalidad_id as PAGADOR-NACIONALIDAD',
                    'poliza_pagador.nu_documento as PAGADOR-DOCUMENTO',
                    'tipo_persona.nb_persona AS PAGADOR-TIPO-PERSONA',
                    'poliza_pagador.nb_nombre as PAGADOR-NOMBRE',
                    'poliza_pagador.nb_apellido as PAGADOR-APELLIDO',
                    'bancos.nb_banco as PAGADOR-BANCOS',
                    'medios_pago.nb_medio_pago as PAGADOR-MEDIOS-PAGO',
                    'poliza_pagador.nu_medio_pago  as PAGADOR-NUMERO',
                    'frecuencia_pago.nb_frecuencia_pago as PAGADOR-FRECUENCIA-PAGO',
                    'poliza_pagador.email as PAGADOR-EMAIL',
                    'poliza_pagador.nu_tlf_hogar as PAGADOR-NRO-HOGAR',
                    'poliza_pagador.nu_tlf_celular as PAGADOR-NRO-CELULAR',
                    'poliza_pagador.prima as PAGADOR-PRIMA',

                    'poliza_asegurados.nacionalidad_id as ASEGURADO-NACIONALIDAD',
                    'poliza_asegurados.nu_documento as ASEGURADO-DOCUMENTO',
                    'poliza_asegurados.nb_nombre as ASEGURADO-NOMBRE',
                    'poliza_asegurados.nb_apellido as ASEGURADO-APELLIDO'
                    
                );
        } else
        {
            $query->whereNull('poliza_pagador.prima')
                ->select(
                    'poliza_pagador.nacionalidad_id as PAGADOR-NACIONALIDAD',
                    'poliza_pagador.nu_documento as PAGADOR-DOCUMENTO',
                    'poliza_pagador.nb_nombre as PAGADOR-NOMBRE',
                    'poliza_pagador.nb_apellido AS PAGADOR-APELLIDO',
                    'poliza_pagador.nu_medio_pago  AS PAGADOR-NUMERO-MEDIO-PAGO',
                    'poliza_pagador.email as PAGADOR-EMAIL',
                    'poliza_pagador.nu_tlf_hogar as PAGADOR-NRO-HOGAR',
                    'poliza_pagador.nu_tlf_celular as PAGADOR-NRO-CELULAR'
                );
        }
    }

    public function scopeOtras($query)
    {
        $query->join('poliza_asegurados','poliza_asegurados.cliente_id','=','poliza_pagador.clientes_id')
            ->join('bancos','bancos.id','=','poliza_pagador.banco_id')
            ->join('tipo_persona','tipo_persona.id','=','poliza_pagador.tipo_persona_id')
            ->join('campana','campana.id','=','poliza_pagador.campana_id')
            ->join('ramos','ramos.id','=','poliza_pagador.ramo_id')
            ->join('productos','productos.id','=','poliza_pagador.producto_id')
            ->join('planes','planes.id','=','poliza_pagador.plan_id')
            ->join('medios_pago','medios_pago.id','=','poliza_pagador.medio_pago_id')
            ->join('frecuencia_pago','frecuencia_pago.id','=','poliza_pagador.frecuencia_pago_id');
    }

}
