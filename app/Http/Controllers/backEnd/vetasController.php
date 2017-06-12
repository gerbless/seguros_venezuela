<?php

namespace App\Http\Controllers\backEnd;


use App\Http\Controllers\Controller;
use App\Model\actividadEconomicaCivilModel;
use App\Model\agenciasModel;
use App\Model\bacosModel;
use App\Model\beneficiariosModel;
use App\Model\campanaModel;
use App\Model\datosRiesgoAsegurable;
use App\Model\direccionesModel;
use App\Model\estadoCivilModel;
use App\Model\estadoModel;
use App\Model\frecuenciaPagoModel;
use App\Model\herederosLegalesModel;
use App\Model\mediosPagoModel;
use App\Model\nacionalidadModel;
use App\Model\nivelEducativoModel;
use App\Model\OcupacionModel;
use App\Model\paisModel;
use App\Model\parentescoModel;
use App\Model\PolizaAseguradosModel;
use App\Model\polizaPagadorModel;
use App\Model\sexosModel;
use App\Model\tipoBeneficiario;
use App\Model\tipoPersonaModel;
use App\Model\tipoRiesgo;
use App\Model\tomadorPolizaModel;
use DB;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Model\ventasModel;

class vetasController extends Controller

{
    protected $url;
    protected $idContratante = null;
    
  
    public function __construct(request $request)
    {
        $this->url = $request->path();
        if (!$request->ajax())
            abort(403);
    }

    public function index($clientes)
    {
        $ventas=null;
        $sexo = sexosModel::active()->pluck('nb_sexo', 'id');
        $pagador_poliza = polizaPagadorModel::with('direcciones')->active()->where('clientes_id', $clientes->id)->first();
        if ($pagador_poliza != null)
        {
            foreach ($pagador_poliza->direcciones["attributes"] as $clave => $value)
            {
                if ($clave != "id")
                    $pagador_poliza->$clave = $value;
            }
            //DETERMINAR SI YA VENDIO LA POLIZA PARA NO DEJAR REGISTRAR MAS ASEGURADOS
            $ventas=ventasModel::where('poliza_pagador_id',$pagador_poliza->id)->count();
            if($ventas==1)
                $ventas="disabled";
        }
        $nacionalidad_id = nacionalidadModel::active()->nacional()->pluck('nb_nacionalidad', 'id');
        $tipo_persona_id = tipoPersonaModel::active()->pluck('nb_persona', 'id');
        $medio_pago_id = mediosPagoModel::active()->pluck('nb_medio_pago', 'id');
        $pais_id = paisModel::active()->pluck('nb_pais', 'id');
        $estado_id = estadoModel::active()->pluck('nb_estado', 'id');
        $parentesco_id = parentescoModel::active()->pluck('nb_parentesco', 'id');
        $tipobeneficiario_id = tipoBeneficiario::active()->pluck('nb_tipo_beneficiario', 'id');
        $tipo_riesgo_id = tipoRiesgo::active()->pluck('nb_tipo_riesgo', 'id');
        $datos_riesgo_asegurable = datosRiesgoAsegurable::active()->where('clientes_id', $clientes->id)->get();
        $nivel_educativo_id = nivelEducativoModel::active()->pluck('nb_nivel_educativo', 'id');
        $ocupacion_id = OcupacionModel::active()->pluck('nb_ocupacion', 'id');
        $estadocivil_id = estadoCivilModel::pluck('nb_estatocivil', 'id');
        $activida_economica_id = actividadEconomicaCivilModel::active()->pluck('nb_actividad_economica', 'id');
        $sexo_id = sexosModel::active()->pluck('nb_sexo', 'id');
        $poliza_asegurados = PolizaAseguradosModel::with('direccion')->active()->where('cliente_id', $clientes->id)->get();
        if ($poliza_asegurados->count() > 0)
        {
            foreach ($poliza_asegurados[0]->direccion["attributes"] as $clave => $value)
            {
                if ($clave != "id")
                    $poliza_asegurados[0]->$clave = $value;
            }
        }
        $bancos_id = bacosModel::active()->pluck('nb_banco', 'id');
        $agencias = agenciasModel::active()->pluck('nb_tipo_beneficiario', 'id');
        $campana_id = campanaModel::where('id',$clientes->campana)->active()->pluck('nb_campana', 'id');
        $frecuencia_pago_id = frecuenciaPagoModel::active()->pluck('nb_frecuencia_pago', 'id');
        

        return view(
            'back_end.ventas.create', compact(
            'frecuencia_pago_id', 'campana_id', 'agencias', 'bancos_id', 'parentesco_id', 'poliza_asegurados',
            'class_direcciones', 'sexo_id', 'activida_economica_id', 'estadocivil_id', 'ocupacion_id',
            'nivel_educativo_id', 'datos_riesgo_asegurable', 'tipo_riesgo_id', 'tipobeneficiario_id', 'estado_id',
            'sexo', 'clientes', 'pagador_poliza', 'nacionalidad_id', 'tipo_persona_id', 'medio_pago_id', 'pais_id'
            ,'ventas'));
    }

    public function store(request $request)
    {
        switch ($this->url){

            case "datos-pagador-poliza":
                $this->storagePagadorPoliza($request);
                break;
            case "datos-beneficiarios":
                $this->storageBeneficiarios($request);
                break;
            case "datos-asegurado-poliza":
                $this->storageAseguradosPoliza($request);
                break;
                break;
            case "datos-riesgo-asegurables":
                $this->storageRiesgoAsegurable($request);
                break;
        }

        return response()->json($this->mensaje);
    }

    public function listadoBeneficiario($cliente, $polizaAsegurado)
    {

        $beneficiarios_poliza = beneficiariosModel::active()->where('clientes_id', $cliente->id)->where(
            'poliza_asegurado_id', $polizaAsegurado->id)->get();

        return view('back_end.ventas.form.list-beneficiarios', compact('beneficiarios_poliza'));
    }

    public function listadoDatosRiesgoAsegurable($cliente)
    {
        $datos_riesgo_asegurable = datosRiesgoAsegurable::active()->where('clientes_id', $cliente->id)->get();

        return view('back_end.ventas.form.list-datos-riesgo-asegurables', compact('datos_riesgo_asegurable'));
    }

    public function listadoPolizaAsegurados($cliente)
    {
        $poliza_asegurados = PolizaAseguradosModel::active()->where('cliente_id', $cliente->id)->get();

        return view('back_end.ventas.form.list-datos-asegurados-poliza', compact('poliza_asegurados'));
    }

    public function addBeneficiarios($datos)
    {
        $heredero_id = herederosLegalesModel::active()->pluck('nb_heredero', 'id');
        $tipo_persona_id = tipoPersonaModel::active()->pluck('nb_persona', 'id');
        $nacionalidad_id = nacionalidadModel::active()->nacional()->pluck('nb_nacionalidad', 'id');
        $parentesco_id = parentescoModel::active()->pluck('nb_parentesco', 'id');
        $tipobeneficiario_id = tipoBeneficiario::active()->pluck('nb_tipo_beneficiario', 'id');
        $beneficiarios_poliza = beneficiariosModel::active()
            ->where('clientes_id', $datos->cliente_id)
            ->where('poliza_asegurado_id', $datos->id)
            ->get();

        return view(
            'back_end.ventas.beneficiarios.create', compact(
            'datos', 'heredero_id', 'tipo_persona_id', 'nacionalidad_id', 'parentesco_id', 'tipobeneficiario_id',
            'beneficiarios_poliza'));
    }

    public function update(request $request, $datos)
    {
        $datos->fill($request->all());
        $datos->save();

        $direccion = direccionesModel::find($request->direccion_id);
        $direccion->fill($request->all());
        $result = $direccion->save();

        if ($result)
        {
            return response()->json(['menj' => 'Datos actualizados', 'tipo' => 'aprobado']);
        }

        return response()->json(
            ['menj' => 'No se pudo generar el registro. Contacte al administrador del sistema', 'tipo' => 'rechazado']);
    }

    private function storageRiesgoAsegurable($request)
    {
        try
        {
            DB::beginTransaction();
                $idsAsegurados = collect(explode(',', $request->asegurados_id));
                $pagadorPoliza=polizaPagadorModel::with('cliente','frecuencia','campana','nacionalidades','direcciones','tipoPersona','mediopago','bancos','plan','ramo','producto')
                    ->where('clientes_id', $request->clientes_id)->active();
                $todosAsegurados=PolizaAseguradosModel::with('beneficiarios')->find(explode(',', $request->asegurados_id));

               if($todosAsegurados->count()> 0){


                    $semaforo = 1;
                    foreach ($idsAsegurados as $id)
                    {
                        $beneficiario = beneficiariosModel::where(
                            [
                                ['clientes_id', $request->clientes_id],
                                ['poliza_asegurado_id', $id]
                            ])->active();

                        if ($beneficiario->count() == 0)
                        {
                            $semaforo = 0;
                            $Asegurado = PolizaAseguradosModel::find($id);
                        }
                    }

                    if ($semaforo == 1 && $pagadorPoliza->count() == 1)
                    {
                        PolizaAseguradosModel::where('cliente_id', $request->clientes_id)->update(["tarifario_id" => $request->tarifario_id]);

                         polizaPagadorModel::where('clientes_id', $request->clientes_id)->update([
                             "campana_id" => $request->campana_id,
                             "ramo_id" => $request->ramo_id,
                             "producto_id" => $request->producto_id,
                             "plan_id" => $request->plan_id,
                             "frecuencia_pago_id" => $request->frecuencia_pago_id,
                             "prima" => $request->valor_prima]);
                        $this->ventas($request,$pagadorPoliza->first(),$todosAsegurados);
                        $this->mensaje=array(
                            "menj"=>"Datos de la poliza registrado con exito.",
                            "tipo"=>"aprobado",
                            "hinabilty"=>"n"
                        );

                    } else
                    {

                        switch ($semaforo){
                            case 0:
                                $this->mensaje=array(
                                    "menj"=>'El asegurado <b>' . $Asegurado->nb_nombre . '</b> <b>' . $Asegurado->nb_apellido . '</b> le falta al menos un beneficiario en caso de muerte.',
                                    "tipo"=>"rechazado",
                                );
                                break;

                            case 1:
                                $this->mensaje=array(
                                    "menj"=>'Debe registrar un Pagador de la poliza.',
                                    "tipo"=>"rechazado",
                                );
                                break;

                            default:
                        }
                    }
               }  else{
                   $this->mensaje=array(
                       "menj"=>"Deben Registrar al menos uno (1) Asegurado.",
                       "tipo"=>"rechazado",
                   );
               }
            DB::commit();
        } catch (QueryException $e)
        {
            DB::rollBack();
            $this->mensajeErrorQuery($e);
        }

        return $this->mensaje;
    }

    private function ventas($request,$pagadorPoliza,$asegurados)
    {
      $agente= \Auth::user();
      $poliza=  array('poliza'=>
                       array('co_campana' => $request->campana_id,
                             'co_ramo' => $request->ramo_id,
                             'co_producto' => $request->producto_id,
                             'co_plan' => $request->plan_id,
                             'co_frecuencia_pago' => $request->frecuencia_pago_id,
                             'campana' => $pagadorPoliza->campana->nb_campana,
                             'ramo' => $pagadorPoliza->ramo->nb_ramo,
                             'producto' => $pagadorPoliza->producto->nb_producto,
                             'plan' => $pagadorPoliza->plan->nb_plan,
                             'frecuencia_pago' => $pagadorPoliza->frecuencia->nb_frecuencia_pago,
                             'nro_asegurados' => $request->nu_beneficiarios_requeridos,
                             'valor_prima' => $request->valor_prima,
                             'total_prima' => $request->valor_prima_golbal,
                             'agente' => $agente->name,
                             'id_data' => $pagadorPoliza->cliente->id,
                             'cliente_data' => $pagadorPoliza->cliente->cliente,
                             'nro_lote' => $pagadorPoliza->cliente->lote_id,
                             'pagador_poliza'=> $pagadorPoliza->toArray(),
                             'asegurados_poliza'=> $asegurados->toArray()
                       ),
                );
        $ventas=ventasModel::where("poliza_pagador_id",$pagadorPoliza->id);
        if($ventas->count()==0){
            ventasModel::create([
                "tarifario_id" => $request->tarifario_id,
                "poliza_pagador_id" => $pagadorPoliza->id,
                "users_id" =>$agente->id,
                "monto" => $request->valor_prima,
                "total" => $request->valor_prima_golbal,
                "nu_asegurados" => $request->nu_beneficiarios_requeridos,
                "reporte_poliza" => json_encode($poliza),
                "status_id" => 1,
                "created_at" => Carbon::now(),
                "update_at" => Carbon::now()

            ]);
        }else{
            $ventas->update([
                "tarifario_id" => $request->tarifario_id,
                "poliza_pagador_id" => $pagadorPoliza->id,
                "users_id" =>$agente->id,
                "monto" => $request->valor_prima,
                "total" => $request->valor_prima_golbal,
                "nu_asegurados" => $request->nu_beneficiarios_requeridos,
                "reporte_poliza" => json_encode($poliza),
                "status_id" => 1,
            ]);
        }

    }

    private function storagePagadorPoliza($request)
    {
        try
        {
            DB::beginTransaction();
            direccionesModel::create($request->all());
            $idDireccion = direccionesModel::all()->last();
            polizaPagadorModel::create($request->all());
            $idPolizaPagador = polizaPagadorModel::all()->last();
            polizaPagadorModel::where('id', $idPolizaPagador->id)->update(["direccion_id" => $idDireccion->id]);
            tomadorPolizaModel::create($request->all());
            $idTomadorPoliza = tomadorPolizaModel::all()->last();
            tomadorPolizaModel::where('id', $idTomadorPoliza->id)->update(["direccion_id" => $idDireccion->id]);
            DB::commit();
            $this->mensaje=array(
                "menj"=>"Pagador de la poliza registrado con exito.",
                "tipo"=>"aprobado",
                "hinabilty"=>"S",
                "idpagador"=>$idPolizaPagador->id
            );
        } catch (QueryException $e)
        {
            DB::rollBack();
            $this->mensajeErrorQuery($e);
        }

        return $this->mensaje;
    }
    
    private function storageAseguradosPoliza($request)
    {
        try{
            DB::beginTransaction();
              direccionesModel::create($request->all());
              $idDireccion = direccionesModel::all()->last();
              PolizaAseguradosModel::create($request->all());
              $idPolizaAsegurado = PolizaAseguradosModel::all()->last();
              PolizaAseguradosModel::where('id', $idPolizaAsegurado->id)->update(["direccion_id" => $idDireccion->id]);
            DB::commit();
            $this->mensaje=array(
                "menj"=>"Asegurado de la poliza registrado con exito.",
                "tipo"=>"aprobado",
                "hinabilty"=>"S",
                "list"=>"listado-datos-poliza-asegurados/" . $request->cliente_id
            );
        }catch(QueryException $e){
            DB::rollBack();
            $this->mensajeErrorQuery($e);
        }
    }

    private function storageBeneficiarios($request)
    {
        try{
            beneficiariosModel::create($request->all());
            $this->mensaje=array(
                "menj"=>"Beneficiario de la poliza registrado con exito.",
                "tipo"=>"aprobado",
                "hinabilty"=>"S",
                "list"=>"listado-beneficiarios/" . $request->clientes_id . "/" . $request->poliza_asegurado_id
            );
        }catch(QueryException $e){
            $this->mensajeErrorQuery($e);
        }
    }

    
}
