<?php

namespace App\Http\Controllers\backEnd\tablasMaestras;

use App\Model\statusModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\coberturasModel;
use App\Model\planesModel;
class coberturasController extends Controller
{
    public function __construct(request $request)
    {
        if (!$request->ajax()) abort(403);
    }

    public function index()
    {
        $data=coberturasModel::with('planes')->with('status')->active()->get();
        return view($this->rutaviewTM."coberturas.index",compact('data'));
    }

    public function create()
    {
        $plan_id=planesModel::pluck('nb_plan','id');
        $status_id=statusModel::usables()->pluck('nb_status','id');
        return view($this->rutaviewTM."coberturas.create",compact('plan_id','status_id'));
    }

    public function store(request $request)
    {
        $result=coberturasModel::create($request->all());
        if($result)
        {
            return response()->json(array('menj'=>'Registrado Correctamente','ruta'=>'listado-cobertura','tipo'=>'aprobado'));
        }else{
            return response()->json(array('menj'=>'Hubo un error vuelva a intentarlo','tipo'=>'rechazado'));
        }

    }

    public function edit($data)
    {
        $plan_id=planesModel::pluck('nb_plan','id');
        $status_id=statusModel::usables()->pluck('nb_status','id');
        return view($this->rutaviewTM."coberturas.edit",compact('plan_id','status_id','data'));
    }

    public function update(request $request,$data)
    {
        $data->fill($request->all());
        $result=$data->save();
        if($result){
            return response()->json(array('menj'=>'Registrado Correctamente','ruta'=>'listado-cobertura','tipo'=>'aprobado'));
        } else {
            return response()->json(array('menj'=>'Hubo un error vuelva a intentarlo','tipo'=>'rechazado'));
        }
    }
}
