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
        return $query->where('poliza_pagador.status_id', 1);
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

    public function scopeSelectXml($query)
    {
       $query->select(
         //DATOS DEL TOMADOR DE LA POLIZA O PAGADOR
           'poliza_pagador.operador_id',
           'poliza_pagador.sucursal_id',
           'poliza_pagador.ramo_id',
           'poliza_pagador.producto_id',
           'poliza_pagador.ff_registro',
           'poliza_pagador.canal_id',
           'poliza_pagador.canal_id',
           'poliza_pagador.userbanco',
           'poliza_pagador.userproveedor',
           'poliza_pagador.tipo_moneda_id',
           'poliza_pagador.nb_nombre id AS panb_nombre',
           'poliza_pagador.nacionalidad_id AS panacionalidad_id',
           'poliza_pagador.nu_documento AS panu_documento',
           'poliza_pagador.tipo_persona_id AS ptipo_persona_id',
           'poliza_pagador.nb_apellido AS nb_apellido',
           'poliza_pagador.nivel_educativo_id AS nivel_educativo_id',
           'poliza_pagador.ocupacion_id AS pocupacion_id',
           'poliza_pagador.ff_nacimiento AS pff_nacimiento',
           'poliza_pagador.sexo_id AS psexo_id',
           'poliza_pagador.estadocivil_id AS pestadocivil_id',
           'poliza_pagador.nu_hijos AS pnu_hijos',
           'poliza_pagador.email AS pemail',
           'poliza_pagador.nu_tlf_hogar AS pnu_tlf_hogar',
           'poliza_pagador.nu_tlf_celular AS pnu_tlf_celular',
           'poliza_pagador.nb_empresa AS pnb_empresa',
           'poliza_pagador.nb_cargo AS pnb_cargo',
           'poliza_pagador.nu_ingresos AS pnu_ingresos',
           'poliza_pagador.nu_tlf_oficina1 AS pnu_tlf_oficina1',
           'poliza_pagador.nu_tlf_oficina2 AS pnu_tlf_oficina2',
           'poliza_pagador.activida_economica_id AS pactivida_economica_id',
           'poliza_pagador.nu_capital_promedio AS pnu_capital_promedio',
           'poliza_pagador.nu_medio_pago',
           'poliza_pagador.plan_id',
           'poliza_pagador.prima',
           'poliza_pagador.id As idPagador',

           //DATOS DEL ASEGURADO
           'poliza_asegurados.id',
           'poliza_asegurados.nb_nombre',
           'poliza_asegurados.nacionalidad_id',
           'poliza_asegurados.nu_documento',
           'poliza_asegurados.tipo_persona_id',
           'poliza_asegurados.nb_apellido',
           'poliza_asegurados.ff_ultima_actualizacion',
           'poliza_asegurados.nivel_educativo_id',
           'poliza_asegurados.ocupacion_id',
           'poliza_asegurados.ff_nacimiento',
           'poliza_asegurados.sexo_id',
           'poliza_asegurados.estadocivil_id',
           'poliza_asegurados.nu_hijos',
           'poliza_asegurados.email',
           'poliza_asegurados.nu_tlf_hogar',
           'poliza_asegurados.nu_tlf_celular',
           'poliza_asegurados.nb_empresa',
           'poliza_asegurados.nb_cargo',
           'poliza_asegurados.nu_ingresos',
           'poliza_asegurados.nu_tlf_oficina1',
           'poliza_asegurados.nu_tlf_oficina2',
           'poliza_asegurados.activida_economica_id',
           'poliza_asegurados.nu_capital_promedio',
           'poliza_asegurados.cliente_id',

            //DATOS DE DIRECCION DE ASEGURADOS
            'ddAsegurados.pais_id AS dDpais_id',
            'ddAsegurados.estado_id AS dDestado_id',
            'ddAsegurados.nb_parroquia AS dDnb_parroquia',
            'ddAsegurados.co_postal AS dDco_postal',
            'ddAsegurados.tx_avenida_calle AS dDtx_avenida_calle',
            'ddAsegurados.tx_urbanizacion_direccion AS dDtx_urbanizacion_direccion',
            'ddAsegurados.nb_edificio_casa AS dDnb_edificio_casa',
            'ddAsegurados.nu_piso AS dDnu_piso',
            'ddAsegurados.nu_casa AS dDnu_casa',
            'ddaPaises.nb_pais AS dDnb_pais',
            'ddaEstados.nb_estado AS dDnb_estado',
            'ddaCiudades.nb_ciudad AS dDnb_ciudad',
            'ddaMunicipios.nb_municipio AS dDnb_municipio',
            'ddaCiudades.co_xml_ciudad AS dDciudad_id',
            'ddaMunicipios.co_xml_ciudad AS dDmunicipio_id',

            //NIVEL EDUCATIVO DE ASEGURADOS
            'eduAsegurados.nb_nivel_educativo AS educacion_asegurado',

            //OCUPACION DE ASEGURADOS
            'OcupAsegurados.nb_ocupacion AS ocupacion_asegurado',

           //ACTIVIDAD ECONOMICA DE ASEGURADOS
           'ActivityEcoAsegurados.nb_actividad_economica AS activity_asegurado',
       
           //DE POLIZA EN GENERAL
           'frecuencia_pago.cod_xml AS frecuencia_xml',
           'planes.cod_xml AS plan_xml',
           
            //DATOS DE DIRECCION DE ASEGURADOS
            'ddPagador.pais_id AS dDppais_id',
            'ddPagador.estado_id AS dDpestado_id',
            'ddPagador.nb_parroquia AS dDpnb_parroquia',
            'ddPagador.co_postal AS dDpco_postal',
            'ddPagador.tx_avenida_calle AS dDptx_avenida_calle',
            'ddPagador.tx_urbanizacion_direccion AS dDptx_urbanizacion_direccion',
            'ddPagador.nb_edificio_casa AS dDpnb_edificio_casa',
            'ddPagador.nu_piso AS dDpnu_piso',
            'ddPagador.nu_casa AS dDpnu_casa',
            'ddpPaises.nb_pais AS dDpnb_pais',
            'ddpEstados.nb_estado AS dDpnb_estado',
            'ddpCiudades.nb_ciudad AS dDpnb_ciudad',
            'ddpMunicipios.nb_municipio AS dDpnb_municipio',
            'ddpCiudades.co_xml_ciudad AS dDpciudad_id',
            'ddpMunicipios.co_xml_ciudad AS dDpmunicipio_id',
           
            //NIVEL EDUCATIVO DE ASEGURADOS
            'eduPagador.nb_nivel_educativo AS educacion_pagador',

           //OCUPACION DE ASEGURADOS
           'OcupPagador.nb_ocupacion AS ocupacion_pagador',

           //ACTIVIDAD ECONOMICA DE ASEGURADOS
           'ActivityEcoPagador.nb_actividad_economica AS activity_pagador',

            //medio de pago
           'medios_pago.cod_xml AS cod_xml',
           'medios_pago.nb_medio_pago'
       );
    }

    public function scopeNoTransferencias($query)
    {
        $query->where('poliza_pagador.medio_pago_id',"<>",5);
    }

    public function scopeAdress($query,$direcciones,$paises,$estados,$ciudades,$municipios,$rel)
    {
        $query->join('direcciones AS '.$direcciones.'',''.$direcciones.'.id','=',''.$rel.'.direccion_id');
        $query->join('paises AS '.$paises.'',''.$paises.'.id','=',''.$direcciones.'.pais_id');
        $query->join('estados AS '.$estados.'',''.$estados.'.id','=',''.$direcciones.'.estado_id');
        $query->join('ciudades AS '.$ciudades.'',''.$ciudades.'.id','=',''.$direcciones.'.ciudad_id');
        $query->join('municipios AS '.$municipios.'',''.$municipios.'.id','=',''.$direcciones.'.municipio_id');
    }

    public function scopeEducacion($query,$nivel_educativo,$rel)
    {
        $query->leftjoin('nivel_educativo AS '.$nivel_educativo.'',''.$nivel_educativo.'.id','=',''.$rel.'.nivel_educativo_id');
    }

    public function scopeOcupacion($query,$ocupacion,$rel)
    {
        $query->leftjoin('ocupacion AS '.$ocupacion.'',''.$ocupacion.'.id','=',''.$rel.'.ocupacion_id');
    }

    public function scopeActividadEconomica($query,$actividad_economica,$rel)
    {
        $query->leftjoin('activida_economica AS '.$actividad_economica.'',''.$actividad_economica.'.id','=',''.$rel.'.activida_economica_id');
    }
    

}
