<?php

namespace App\Http\Controllers\backEnd\tablasMaestras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\reglaModel;
class tipificacionesController extends Controller
{
    public function __construct(request $request)
    {
        if (!$request->ajax()) abort(403);
    }



    public function index()
    {
        $data=reglaModel::with('tpfnivel1','tpfnivel2','tpfnivel3','tpfnivel4','status')->get();
        return view($this->rutaviewTM."tipificaciones.index",compact('data'));
    }

}
