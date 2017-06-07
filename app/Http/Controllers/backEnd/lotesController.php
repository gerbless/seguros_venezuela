<?php

namespace App\Http\Controllers\backEnd;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\loteMasivoModel;
use App\Model\clientesModel;

class lotesController extends Controller
{
    public function __construct(request $request)
    {
        if(!$request->ajax())
            abort(403);

    }

    public function index()
    {
        $lotes = loteMasivoModel::all();
        return view('back_end.lotes.index')->with("data", $lotes);
    }
    
    public function update(request $request)
    {
        $estado= str_replace('false','2',$request->estado);
        $estado= str_replace('true','0',$estado);
        //COLOCAR PARA ASIGNAR
        //UNICAMENTE LAS STATUS 2. ES DECIR LAS APAGADAS.
        //UNICAMENTE LAS STATUS 0. ES DECIR LAS APAGADAS.
        ($estado==0)? $regis=2 : $regis=0; 
        
        clientesModel::where('lote_id', $request->idLote)->where('status_id',$regis)->update(["status_id" =>$estado]);


        $estado= str_replace('0','1',$estado);
        loteMasivoModel::where('id',$request->idLote)->update(["status_id" =>$estado]);

        return response()->json(['menj' => 'Lote actualizado', 'tipo' => 'aprobado']);
    }
}
