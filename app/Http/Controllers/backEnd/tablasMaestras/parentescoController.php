<?php

namespace App\Http\Controllers\backEnd\tablasMaestras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\parentescoModel;
use App\Model\statusModel;
class parentescoController extends Controller
{
    public function __construct(request $request)
    {
        if (!$request->ajax()) abort(403);
    }



    public function index()
    {
        $data=parentescoModel::with('status')->active()->get();
        return view($this->rutaviewTM."parentesco.index",compact('data'));
    }

    public function create()
    {
        $status_id=statusModel::usables()->pluck('nb_status','id');
        return view($this->rutaviewTM."parentesco.create",compact('status_id'));
    }

    public function store(request $request)
    {
        $result=parentescoModel::create($request->all());
        if($result)
        {
            return response()->json(array('menj'=>'Registrado Correctamente','ruta'=>'listado-parentesto','tipo'=>'aprobado'));
        }else{
            return response()->json(array('menj'=>'Hubo un error vuelva a intentarlo','tipo'=>'rechazado'));
        }

    }

    public function edit($data)
    {
        $status_id=statusModel::usables()->pluck('nb_status','id');
        return view($this->rutaviewTM."parentesco.edit",compact('status_id','data'));
    }

    public function update(request $request,$data)
    {
        $data->fill($request->all());
        $result=$data->save();
        if($result){
            return response()->json(array('menj'=>'Registrado Correctamente','ruta'=>'listado-parentesto','tipo'=>'aprobado'));
        } else {
            return response()->json(array('menj'=>'Hubo un error vuelva a intentarlo','tipo'=>'rechazado'));
        }
    }
}
