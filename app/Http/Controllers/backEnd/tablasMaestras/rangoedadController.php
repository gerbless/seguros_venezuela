<?php

namespace App\Http\Controllers\backEnd\tablasMaestras;

use App\Http\Controllers\Controller;
use App\Model\rangoEdadModel;
use App\Model\statusModel;
use Illuminate\Http\Request;

class rangoedadController extends Controller
{
    public function index()
    {
        $data = rangoEdadModel::where('status_id', 1)->get();
        return view($this->rutaviewTM . "rangoedades.index", compact('data'));
    }

    public function create()
    {
        $status_id = statusModel::usables()->pluck('nb_status', 'id');
        return view($this->rutaviewTM . "rangoedades.create", compact('status_id'));
    }

    public function store(request $request)
    {
        $result = rangoEdadModel::create($request->all());
        if ($result)
        {
            return response()->json(
                array('menj' => 'Registrado Correctamente', 'ruta' => 'listar-rango', 'tipo' => 'aprobado'));
        } else
        {
            return response()->json(array('menj' => 'Hubo un error vuelva a intentarlo', 'tipo' => 'rechazado'));
        }
    }

    public function edit($data)
    {
        $rango = rangoEdadModel::where('id', $data)->first();
        $status_id = statusModel::usables()->pluck('nb_status', 'id');
        return view($this->rutaviewTM . "rangoedades.edit", compact('status_id', 'rango'));
    }

    public function update(request $request, $data)
    {
        $result = rangoEdadModel::where('id', $data)->update(
            ['minimo' => $request->minimo, 'maximo' => $request->maximo, 'status_id' => $request->status_id]);

        if ($result)
        {
            return response()->json(
                array('menj' => 'Registrado Correctamente', 'ruta' => 'listar-rango', 'tipo' => 'aprobado'));
        } else
        {
            return response()->json(array('menj' => 'Hubo un error vuelva a intentarlo', 'tipo' => 'rechazado'));
        }
    }
}
