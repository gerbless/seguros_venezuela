<?php

namespace App\Http\Controllers\backEnd;


use App\Model\frecuenciaPagoModel;
use App\Model\polizaPagadorModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\sexosModel;
use App\Model\nacionalidadModel;
use App\Model\tipoPersonaModel;
use App\Model\mediosPagoModel;
use App\Model\paisModel;
use App\Model\estadoModel;
use App\Model\direccionesModel;
use App\Model\tomadorPolizaModel;
use App\Model\beneficiariosModel;
use App\Model\parentescoModel;
use App\Model\herederosLegalesModel;
use App\Model\tipoBeneficiario;
use App\Model\datosRiesgoAsegurable;
use App\Model\tipoRiesgo;
use App\Model\nivelEducativoModel;
use App\Model\OcupacionModel;
use App\Model\estadoCivilModel;
use App\Model\actividadEconomicaCivilModel;
use App\Model\PolizaAseguradosModel;
use App\Model\bacosModel;
use App\Model\agenciasModel;
use App\Model\campanaModel;
use DB;


class vetasController extends Controller

{
    protected $url;
    protected $idContratante = null;

    public function __construct(request $request)
    {
        $this->url = $request->path();
        if(!$request->ajax())
            abort(403);
    }

    public function index($clientes)
    {
        $sexo = sexosModel::active()->pluck('nb_sexo', 'id');
        $pagador_poliza = polizaPagadorModel::with('direcciones')->active()->where('clientes_id', $clientes->id)->first();
        if($pagador_poliza!=null){
            foreach($pagador_poliza->direcciones["attributes"] as $clave => $value) {
                if($clave!="id")
                    $pagador_poliza->$clave = $value;
            }
        }
        $nacionalidad_id = nacionalidadModel::active()->nacional()->pluck('nb_nacionalidad', 'id');
        $tipo_persona_id = tipoPersonaModel::active()->pluck('nb_persona', 'id');
        $medio_pago_id = mediosPagoModel::active()->pluck('nb_medio_pago', 'id');
        $pais_id = paisModel::active()->pluck('nb_pais', 'id');
        $estado_id = estadoModel::active()->pluck('nb_estado', 'id');
        //$beneficiarios_poliza=beneficiariosModel::active()->where('clientes_id',$clientes->id)->get();
        //$heredero_id=herederosLegalesModel::active()->pluck('nb_heredero','id');
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
        if($poliza_asegurados->count() > 0){
            foreach($poliza_asegurados[0]->direccion["attributes"] as $clave => $value) {
                if($clave!="id")
                    $poliza_asegurados[0]->$clave = $value;
            }
        }
        $bancos_id = bacosModel::active()->pluck('nb_banco', 'id');
        $agencias = agenciasModel::active()->pluck('nb_tipo_beneficiario', 'id');
        $campana_id = campanaModel::active()->pluck('nb_campana', 'id');
        $frecuencia_pago_id = frecuenciaPagoModel::active()->pluck('nb_frecuencia_pago', 'id');

        return view('back_end.ventas.create', compact('frecuencia_pago_id', 'campana_id', 'agencias', 'bancos_id', 'parentesco_id', 'poliza_asegurados', 'class_direcciones', 'sexo_id', 'activida_economica_id', 'estadocivil_id', 'ocupacion_id', 'nivel_educativo_id', 'datos_riesgo_asegurable', 'tipo_riesgo_id', 'tipobeneficiario_id', 'estado_id', 'sexo', 'clientes', 'pagador_poliza', 'nacionalidad_id', 'tipo_persona_id', 'medio_pago_id', 'pais_id'));
    }

    public function store(request $request)
    {

        if($this->url == "datos-pagador-poliza"){

           $exite=polizaPagadorModel::where('clientes_id',$request->clientes_id)->count();
            if($exite == 0){
                DB::beginTransaction();
                $result = direccionesModel::create($request->all());
                if(!$result):
                    DB::rollBack();
                else:
                    $idDireccion = direccionesModel::all()->last();
                    $result = polizaPagadorModel::create($request->all());
                    if(!$result):
                        DB::rollBack();
                    else:
                        $idPolizaPagador = polizaPagadorModel::all()->last();
                        $result = polizaPagadorModel::where('id', $idPolizaPagador->id)->update(["direccion_id" => $idDireccion->id]);
                        if(!$result):
                            DB::rollBack();
                        else:
                            $result = tomadorPolizaModel::create($request->all());
                            if(!$result):
                                DB::rollBack();
                            else:
                                if(!$result):
                                    DB::rollBack();
                                else:
                                    $idTomadorPoliza = tomadorPolizaModel::all()->last();
                                    $result = tomadorPolizaModel::where('id', $idTomadorPoliza->id)->update(["direccion_id" => $idDireccion->id]);
                                    if(!$result):
                                        DB::rollBack();
                                    else:
                                        DB::commit();
                                    endif;
                                endif;
                            endif;
                        endif;
                    endif;
                endif;
            }
        } elseif($this->url == "datos-beneficiarios") {
            beneficiariosModel::create($request->all());

            return response()->json(['menj' => 'Datos registrado con exito', 'tipo' => 'aprobado', 'list' => 'listado-beneficiarios/' . $request->clientes_id . '/' . $request->poliza_asegurado_id . '']);

        } elseif($this->url == "datos-riesgo-asegurables") {
            if($request->tarifario_id != 0){
                $num = PolizaAseguradosModel::where('cliente_id', $request->clientes_id)->active()->count();
                $numB = beneficiariosModel::where('clientes_id', $request->clientes_id)->count();
                if($num > 0 && $numB > 0){
                    PolizaAseguradosModel::where('cliente_id', $request->clientes_id)->update(["tarifario_id" => $request->tarifario_id]);
                    $result = polizaPagadorModel::where('clientes_id', $request->clientes_id)->update(["campana_id" => $request->campana_id, "ramo_id" => $request->ramo_id, "producto_id" => $request->producto_id, "plan_id" => $request->plan_id, "frecuencia_pago_id" => $request->frecuencia_pago_id, "prima" => $request->valor_prima]);

                } else {
                    return response()->json(['menj' => 'Para continuar debe tener registrado un asegurado con su respectivo beneficiario.', 'tipo' => 'rechazado']);
                }

            }
            // datosRiesgoAsegurable::create($request->all());
            // return response()->json(array('menj'=>'Datos registrado con exito','tipo'=>'aprobado','list'=>'listado-datos-riesgo-asegurables/'.$request->clientes_id.''));

        } elseif($this->url == "datos-asegurado-poliza") {
            DB::beginTransaction();
            $result = direccionesModel::create($request->all());
            if(!$result):
                DB::rollBack();
            else:
                $idDireccion = direccionesModel::all()->last();
                $result = PolizaAseguradosModel::create($request->all());
                if(!$result):
                    DB::rollBack();
                else:
                    $idPolizaAsegurado = PolizaAseguradosModel::all()->last();
                    $result = PolizaAseguradosModel::where('id', $idPolizaAsegurado->id)->update(["direccion_id" => $idDireccion->id]);
                    if(!$result):
                        DB::rollBack();
                    else:
                        DB::commit();
                    endif;
                endif;
            endif;

            return response()->json(['menj' => 'Datos registrado con exito', 'tipo' => 'aprobado', 'list' => 'listado-datos-poliza-asegurados/' . $request->cliente_id . '']);
        }

        if(isset($result)){
            // return response()->json(array('menj'=>'Datos registrado con exito','tipo'=>'aprobado','listado'=>'listado-afiliados/'.$request->clientes_id.''));
            return response()->json(['menj' => 'Datos registrado con exito', 'tipo' => 'aprobado']);
        }

        return response()->json(['menj' => 'No se pudo generar el registro. Verifique la información', 'tipo' => 'rechazado']);

    }

    public function listadoBeneficiario($cliente, $polizaAsegurado)
    {

        $beneficiarios_poliza = beneficiariosModel::active()->where('clientes_id', $cliente->id)->where('poliza_asegurado_id', $polizaAsegurado->id)->get();

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

        return view('back_end.ventas.beneficiarios.create', compact('datos', 'heredero_id', 'tipo_persona_id', 'nacionalidad_id', 'parentesco_id', 'tipobeneficiario_id', 'beneficiarios_poliza'));
    }

    public function update(request $request, $datos)
    {
        $datos->fill($request->all());
        $datos->save();

        $direccion = direccionesModel::find($request->direccion_id);
        $direccion->fill($request->all());
        $result = $direccion->save();

        if($result){
            return response()->json(['menj' => 'Datos actualizados', 'tipo' => 'aprobado']);
        }

        return response()->json(['menj' => 'No se pudo generar el registro. Contacte al administrador del sistema', 'tipo' => 'rechazado']);
    }

}
