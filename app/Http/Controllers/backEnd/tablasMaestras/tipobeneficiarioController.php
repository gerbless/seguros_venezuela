<?php

namespace App\Http\Controllers\backEnd\tablasMaestras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\tipoBeneficiario;
use App\Model\statusModel;
class tipobeneficiarioController extends Controller
{
    public function __construct(request $request)
    {
        if (!$request->ajax()) abort(403);
    }



    public function index()
    {
        $data=tipoBeneficiario::with('status')->active()->get();
        return view($this->rutaviewTM."tipobeneficiario.index",compact('data'));
    }

    public function create()
    {
        $status_id=statusModel::usables()->pluck('nb_status','id');
        return view($this->rutaviewTM."tipobeneficiario.create",compact('status_id'));
    }

    public function store(request $request)
    {
        $result=tipoBeneficiario::create($request->all());
        if($result)
        {
            return response()->json(array('menj'=>'Registrado Correctamente','ruta'=>'listado-tipo-beneficiario','tipo'=>'aprobado'));
        }else{
            return response()->json(array('menj'=>'Hubo un error vuelva a intentarlo','tipo'=>'rechazado'));
        }

    }

    public function edit($data)
    {
        dd($data);
        $status_id=statusModel::usables()->pluck('nb_status','id');
        return view($this->rutaviewTM."tipobeneficiario.edit",compact('status_id','data'));
    }

    public function update(request $request,$data)
    {
        $data->fill($request->all());
        $result=$data->save();
        if($result){
            return response()->json(array('menj'=>'Registrado Correctamente','ruta'=>'listado-tipo-beneficiario','tipo'=>'aprobado'));
        } else {
            return response()->json(array('menj'=>'Hubo un error vuelva a intentarlo','tipo'=>'rechazado'));
        }
    }
}
