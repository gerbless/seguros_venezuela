<?php

namespace App\Http\Controllers\backEnd\tablasMaestras;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\bacosModel;
use App\Model\statusModel;


class bancosController extends Controller
{
    public function __construct(request $request)
    {
        if(!$request->ajax())
            abort(403);
    }

    public function index()
    {
        $data = bacosModel::with('status')->get();

        return view($this->rutaviewTM . "bancos.index", compact('data'));
    }

    public function create()
    {
        $status_id = statusModel::usables()->pluck('nb_status', 'id');

        return view($this->rutaviewTM . "bancos.create", compact('status_id'));
    }

    public function store(request $request)
    {
        $result = bacosModel::create($request->all());
        if($result){
            return response()->json(['menj' => 'Registrado Correctamente', 'ruta' => 'listado-banco', 'tipo' => 'aprobado']);
        } else {
            return response()->json(['menj' => 'Hubo un error vuelva a intentarlo', 'tipo' => 'rechazado']);
        }

    }

    public function edit($data)
    {
        $status_id = statusModel::usables()->pluck('nb_status', 'id');

        return view($this->rutaviewTM . "bancos.edit", compact('status_id', 'data'));
    }

    public function update(request $request, $data)
    {
        $data->fill($request->all());
        $result = $data->save();
        if($result){
            return response()->json(['menj' => 'Registrado Correctamente', 'ruta' => 'listado-banco', 'tipo' => 'aprobado']);
        } else {
            return response()->json(['menj' => 'Hubo un error vuelva a intentarlo', 'tipo' => 'rechazado']);
        }
    }
}
