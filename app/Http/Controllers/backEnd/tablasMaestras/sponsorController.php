<?php

namespace App\Http\Controllers\backEnd\tablasMaestras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\sponsorModel;
class sponsorController extends Controller
{
    public function __construct(request $request)
    {
        if (!$request->ajax()) abort(403);
    }



    public function index()
    {
        $data=sponsorModel::all();
        return view($this->rutaviewTM."sponsor.index",compact('data'));
    }

    public function create()
    {
       // $status_id=statusModel::usables()->pluck('nb_status','id');
        return view($this->rutaviewTM."sponsor.create");
    }

    public function store(request $request)
    {
        $result=sponsorModel::create($request->all());
        if($result)
        {
            return response()->json(array('menj'=>'Registrado Correctamente','ruta'=>'listado-sponsor','tipo'=>'aprobado'));
        }else{
            return response()->json(array('menj'=>'Hubo un error vuelva a intentarlo','tipo'=>'rechazado'));
        }

    }

    public function edit($data)
    {
        //$status_id=statusModel::usables()->pluck('nb_status','id');
        return view($this->rutaviewTM."sponsor.edit",compact('data'));
    }

    public function update(request $request,$data)
    {
        $data->fill($request->all());
        $result=$data->save();
        if($result){
            return response()->json(array('menj'=>'Registrado Correctamente','ruta'=>'listado-sponsor','tipo'=>'aprobado'));
        } else {
            return response()->json(array('menj'=>'Hubo un error vuelva a intentarlo','tipo'=>'rechazado'));
        }
    }
}
