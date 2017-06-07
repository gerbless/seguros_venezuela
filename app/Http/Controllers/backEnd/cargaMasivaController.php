<?php

namespace App\Http\Controllers\backEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\loteMasivoModel;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Model\clientesModel;
use App\Model\campanaModel;
use App\Model\sponsorModel;
use Session;
use Redirect;
class cargaMasivaController extends Controller
{
    public function index()
    {
        $campana_id = campanaModel::active()->pluck('nb_campana', 'id');
        $sponsor = sponsorModel::pluck('nb_sponsor', 'id');
        return view('back_end.cargamasiva.carga',compact('campana_id','sponsor'));
    }
    public function getArchivo(Request $request){
            $archivo= $request->file('sel_file');
            $nombre_original = $archivo->getClientOriginalName();
            $extension = $archivo->getClientOriginalExtension();
            $r1=Storage::disk('public')->put('cargas/'.$nombre_original,  \File::get($archivo));
            $ruta  =  public_path('cargas') ."/". $nombre_original;
            if($r1){
                Excel::selectSheetsByIndex(0)->load($ruta, function($hoja) use ($request){
                    $numItems=$hoja->all()->count();
                      if($numItems > 1000)
                      {
                          Session::flash('message-danger','el archivo contiene '.$numItems.' registros y la cantidad maxima permitida es 1000.');
                          return redirect('home');
                      }
                       $loteId = loteMasivoModel::insertlote($hoja->title."_".date('d-m-Y'),$numItems);

                    $hoja->each(function($fila) use ($request,$loteId){
                        if($fila->documento != ''){
                             clientesModel::insertcliente($fila->nombres,
                                 str_replace('.0','',$fila->documento),
                                 str_replace('.0','',$fila->cod1.$fila->telefono1),
                                 str_replace('.0','',$fila->cod2.$fila->telefono2),
                                 $fila->correo,
                                 $request->sponsor,
                                 $loteId,
                                 str_replace('.0','',$fila->nacionalidad),
                                 str_replace('.0','',$fila->sexo),
                                 str_replace('.0','',$fila->edo_civil),
                                 $request->plan_id,
                                 round($fila->edad),
                                 $request->campana_id,
                                 $request->ramo_id,
                                 $request->producto_id
                             );
                        }
                    });
                    Session::flash('message-success','Carga masiva registrada con exito!!! bajo el nombre de: '.$hoja->title."_".date('d-m-Y'));
                });
            }

        return redirect('home');
    }
}
