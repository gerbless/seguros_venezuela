<?php

namespace App\Http\Controllers\backEnd\tablasMaestras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\planesModel;
use App\Model\statusModel;
use App\Model\productosModel;
class planesController extends Controller
{
    public function __construct(request $request)
    {
        if (!$request->ajax()) abort(403);
    }



    public function index()
    {
        $data=planesModel::with('producto')->with('status')->active()->get();
        return view($this->rutaviewTM."planes.index",compact('data'));
    }

    public function create()
    {
        $status_id=statusModel::usables()->pluck('nb_status','id');
        $producto_id=productosModel::active()->pluck('nb_producto','id');
        return view($this->rutaviewTM."planes.create",compact('status_id','producto_id'));
    }

    public function store(request $request)
    {
        $result=planesModel::create($request->all());
        if($result)
        {
            return response()->json(array('menj'=>'Registrado Correctamente','ruta'=>'listado-planes','tipo'=>'aprobado'));
        }else{
            return response()->json(array('menj'=>'Hubo un error vuelva a intentarlo','tipo'=>'rechazado'));
        }

    }

    public function edit($data)
    {
        $status_id=statusModel::usables()->pluck('nb_status','id');
        $producto_id=productosModel::active()->pluck('nb_producto','id');
        return view($this->rutaviewTM."planes.edit",compact('status_id','data','producto_id'));
    }

    public function update(request $request,$data)
    {
        $data->fill($request->all());
        $result=$data->save();
        if($result){
            return response()->json(array('menj'=>'Registrado Correctamente','ruta'=>'listado-planes','tipo'=>'aprobado'));
        } else {
            return response()->json(array('menj'=>'Hubo un error vuelva a intentarlo','tipo'=>'rechazado'));
        }
    }
}
