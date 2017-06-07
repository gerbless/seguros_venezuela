<?php

namespace App\Http\Controllers\backEnd\tablasMaestras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ramosModel;
use App\Model\statusModel;
use App\Model\campanaModel;
class ramosController extends Controller
{
    public function __construct(request $request)
    {
        if (!$request->ajax()) abort(403);
    }



    public function index()
    {
        $data=ramosModel::with('campana')->with('status')->active()->get();
        return view($this->rutaviewTM."ramos.index",compact('data'));
    }

    public function create()
    {
        $status_id=statusModel::usables()->pluck('nb_status','id');
        $campana_id=campanaModel::active()->pluck('nb_campana','id');
        return view($this->rutaviewTM."ramos.create",compact('status_id','campana_id'));
    }

    public function store(request $request)
    {
        $result=ramosModel::create($request->all());
        if($result)
        {
            return response()->json(array('menj'=>'Registrado Correctamente','ruta'=>'listado-ramos','tipo'=>'aprobado'));
        }else{
            return response()->json(array('menj'=>'Hubo un error vuelva a intentarlo','tipo'=>'rechazado'));
        }

    }

    public function edit($data)
    {
        $status_id=statusModel::usables()->pluck('nb_status','id');
        $campana_id=campanaModel::active()->pluck('nb_campana','id');
        return view($this->rutaviewTM."ramos.edit",compact('status_id','data','campana_id'));
    }

    public function update(request $request,$data)
    {
        $data->fill($request->all());
        $result=$data->save();
        if($result){
            return response()->json(array('menj'=>'Registrado Correctamente','ruta'=>'listado-ramos','tipo'=>'aprobado'));
        } else {
            return response()->json(array('menj'=>'Hubo un error vuelva a intentarlo','tipo'=>'rechazado'));
        }
    }
}
