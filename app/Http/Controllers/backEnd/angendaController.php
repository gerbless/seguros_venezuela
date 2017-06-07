<?php

namespace App\Http\Controllers\backEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\agendamientosModel;
use Carbon\Carbon;
class angendaController extends Controller
{
    public function __construct(request $request)
    {
        if (!$request->ajax()) abort(403);

    }
    
    public function index($telefono,$cliente)
    {
      $agendamiento=agendamientosModel::find($telefono);
        return view('back_end.agenda.index',compact('agendamiento','cliente','telefono'));
    }
    
    public function store(request $request)
    {
        if($request->nro==1)
        {
            $result=agendamientosModel::create($request->all());
        }else{
            $agen=agendamientosModel::find($request->id);
            $agen->fill($request->all());
            $result=$agen->save();    
        }

        if($result)
        {
            return response()->json(array('menj'=>'Agendamiento procesado con exito','tipo'=>'aprobado'));
        }
        
        return abort(500,'Ocurrio un error al intentar realizar el agendamiento.');
    }
    
}
