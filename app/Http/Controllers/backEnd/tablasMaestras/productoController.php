<?php

namespace App\Http\Controllers\backEnd\tablasMaestras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\statusModel;
use App\Model\productosModel;
use App\Model\ramosModel;
class productoController extends Controller
{
    public function __construct(request $request)
    {
        if (!$request->ajax()) abort(403);
    }



    public function index()
    {
        $data=productosModel::with('ramos')->with('status')->active()->get();
        return view($this->rutaviewTM."productos.index",compact('data'));
    }

    public function create()
    {
        $status_id=statusModel::usables()->pluck('nb_status','id');
        $ramo_id=ramosModel::active()->pluck('nb_ramo','id');
        return view($this->rutaviewTM."productos.create",compact('status_id','ramo_id'));
    }

    public function store(request $request)
    {
        $result=productosModel::create($request->all());
        if($result)
        {
            return response()->json(array('menj'=>'Registrado Correctamente','ruta'=>'listado-productos','tipo'=>'aprobado'));
        }else{
            return response()->json(array('menj'=>'Hubo un error vuelva a intentarlo','tipo'=>'rechazado'));
        }

    }

    public function edit($data)
    {
        $status_id=statusModel::usables()->pluck('nb_status','id');
        $ramo_id=ramosModel::active()->pluck('nb_ramo','id');
        return view($this->rutaviewTM."productos.edit",compact('status_id','data','ramo_id'));
    }

    public function update(request $request,$data)
    {
        $data->fill($request->all());
        $result=$data->save();
        if($result){
            return response()->json(array('menj'=>'Registrado Correctamente','ruta'=>'listado-productos','tipo'=>'aprobado'));
        } else {
            return response()->json(array('menj'=>'Hubo un error vuelva a intentarlo','tipo'=>'rechazado'));
        }
    }
}
