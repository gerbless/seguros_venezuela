<?php

namespace App\Http\Controllers\backEnd\tablasMaestras;

use App\Http\Controllers\Controller;
use App\Model\campanaModel;
use App\Model\coberturasModel;
use App\Model\frecuenciaPagoModel;
use App\Model\planesModel;
use App\Model\productosModel;
use App\Model\ramosModel;
use App\Model\rangoEdadModel;
use App\Model\statusModel;
use App\Model\tarifarioModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class tarifarioController extends Controller
{
    public function __construct(request $request)
    {
        if (!$request->ajax()) abort(403);
    }

    public function index()
    {
        $data = tarifarioModel::with('frecuencia')->with('campanas')->with('ramos')->with('productos')->with(
            'planes')->with('status')->active()->get();
        return view($this->rutaviewTM . "tarifario.index", compact('data'));
    }

    public function create()
    {
        $status_id = statusModel::usables()->pluck('nb_status', 'id');
        $campana_id = campanaModel::active()->pluck('nb_campana', 'id');
        $ramo_id = ramosModel::active()->pluck('nb_ramo', 'id');
        $producto_id = productosModel::active()->pluck('nb_producto', 'id');
        $plan_id = planesModel::active()->pluck('nb_plan', 'id');
        $frecuencia_pago_id = frecuenciaPagoModel::active()->pluck('nb_frecuencia_pago', 'id');

        return view($this->rutaviewTM . "tarifario.create",
            compact('status_id', 'campana_id', 'ramo_id', 'producto_id', 'plan_id', 'frecuencia_pago_id'))->with(
            'rangoedad', $this->rangoArr());
    }

    public function store(request $request)
    {
        try{
            $existe=coberturasModel::where('plan_id',$request->plan_id)->count();
            if($existe > 0 ){
                tarifarioModel::create($request->all());
                    $this->mensaje= array('menj' => 'Registrado Correctamente', 'ruta' => 'listado-tarifario', 'tipo' => 'aprobado');
            }else{
                $this->mensaje=array('menj' => 'Debe ingresar las coberturas asociadas al plan.', 'tipo' => 'rechazado');
            }



        }catch (QueryException $e){
            $this->mensajeErrorQuery($e);
        }

        return response()->json($this->mensaje);

    }

    public function edit($data)
    {
        $status_id = statusModel::usables()->pluck('nb_status', 'id');
        $campana_id = campanaModel::active()->pluck('nb_campana', 'id');
        $ramo_id = ramosModel::active()->pluck('nb_ramo', 'id');
        $producto_id = productosModel::active()->pluck('nb_producto', 'id');
        $plan_id = planesModel::active()->pluck('nb_plan', 'id');
        $frecuencia_pago_id = frecuenciaPagoModel::active()->pluck('nb_frecuencia_pago', 'id');
        return view(
            $this->rutaviewTM . "tarifario.edit",
            compact(
                'status_id', 'data', 'campana_id', 'ramo_id', 'producto_id', 'plan_id', 'frecuencia_pago_id'))->with(
            'rangoedad', $this->rangoArr());;
    }

    public function update(request $request, $data)
    {
        $data->fill($request->all());
        $result = $data->save();
        if ($result)
        {
            return response()->json(
                array('menj' => 'Registrado Correctamente', 'ruta' => 'listado-tarifario', 'tipo' => 'aprobado'));
        } else
        {
            return response()->json(array('menj' => 'Hubo un error vuelva a intentarlo', 'tipo' => 'rechazado'));
        }
    }

    private function rangoArr()
    {
        $rangoedad = rangoEdadModel::active()->get();

        foreach ($rangoedad as $value)
        {
            $rang[$value->id] = $value->minimo . " A " . $value->maximo . " Años";
        }

        return $rang;
    }
}
