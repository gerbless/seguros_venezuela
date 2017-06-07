<?php

namespace App\Http\Controllers\backEnd;

use App\Model\polizaPagadorModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Model\contactosModel;
use App\Model\tpfnivel2Model;
use App\Model\tpfnivel3Model;
use App\Model\tpfnivel4Model;
use App\Model\campanaModel;
use Illuminate\Support\Collection as Collection;
use DB;

class excelController extends Controller
{
   public function index()
   {
       return view('back_end.reportes.gestion');
   }

    public function getCruda()
    {
        $desde =date('Y-m-d',strtotime(request()->desde));
        $hasta =date('Y-m-d',strtotime(request()->hasta));
        $contactos=contactosModel::whereBetween(DB::raw('DATE(created_at)'), [$desde, $hasta]);
        Excel::create('Gestión del '.request()->desde.' al '.request()->hasta, function($excel)  use ($contactos){
            $excel->sheet('gestion',function($sheet) use ($contactos){
                $data=[];
                $sheet->freezeFirstRow();
                $sheet->setAutoFilter('A1:L1');
                $sheet->setAutoSize(true);
                //CONFIGURACION ENCABEZADO
                $sheet->cells('A1:L1', function($cells) {
                    $cells->setBackground('#01A9DB');
                    $cells->setAlignment('center');
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '12',
                        'bold'       =>  true
                    ));
                });
                //CONFIGURACION CELDA DATA
                 $nroCeldas=($contactos->count() + 1);
                $sheet->cells('A2:L'.$nroCeldas, function($cells) {
                    $cells->setBackground('#81F7F3');
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '10',
                        'bold'       =>  true
                    ));
                });
                $contactos=$contactos->get();
                foreach ($contactos as $contacto){
                    $n2=tpfnivel2Model::select('nb_tpfnivel2')->find($contacto->tpfnivel2_id);
                    $n3=tpfnivel3Model::select('nb_tpfnivel3')->find($contacto->tpfnivel3_id);
                    $n4=tpfnivel4Model::select('nb_tpfnivel4')->find($contacto->tpfnivel4_id);
                    if($n2==null){ $n2 = Collection::make($n2); $n2->nb_tpfnivel2="N/A";}
                    if($n3==null){ $n3 = Collection::make($n3); $n3->nb_tpfnivel3="N/A";}
                    if($n4==null){ $n4 = Collection::make($n4); $n4->nb_tpfnivel4="N/A";}
                    $datas=[
                        "ID"=>$contacto->id,
                        "TELEFONO"=>$contacto->telefono,
                        "CLIENTE"=>$contacto->clientes->cliente,
                        "DOCUMENTO"=>$contacto->clientes->documento,
                        "TIPIFICACION UNO"=>$contacto->tpfnivel1->nb_tpfnivel1,
                        "TIPIFICACION DOS"=>$n2->nb_tpfnivel2,
                        "TIPIFICACION TRES"=>$n3->nb_tpfnivel3,
                        "TIPIFICACION CUATRO"=>$n4->nb_tpfnivel4,
                        "STATUS"=>$contacto->status->nb_status,
                        "AGENTE"=>$contacto->users->name,
                        "COMENTARIOS"=>$contacto->comentario,
                        "FECHA-HORA"=>date('d-m-Y g:m:s a',strtotime($contacto->created_at)),

                    ];
                    array_push($data,$datas);
                }

                $sheet->FromArray($data,null,'A1');
            });
        })->download('xlsx');

    }

    public  function getVentasNoVentas()
    {
        $campana = campanaModel::active()->pluck('nb_campana', 'id');
        return view('back_end.reportes.ventas',compact('campana'));
    }

    public function rptVentas()
    {
        $desde =date('Y-m-d',strtotime(request()->desde));
        $hasta =date('Y-m-d',strtotime(request()->hasta));

        $data=polizaPagadorModel::whereBetween(DB::raw('DATE(poliza_pagador.created_at)'), [$desde, $hasta])
            ->tipo(request()->tipo,request()->campana)
            ->get();

//        $campana = campanaModel::active()->pluck('nb_campana', 'id');
//        return view('back_end.reportes.ventas',compact('campana'));
        Excel::create('Ventas '.request()->desde.' al '.request()->hasta, function($excel)  use ($data){
            $excel->sheet(request()->campana,function($sheet) use ($data){



                $sheet->fromModel($data,null,'A1',false,true);
            });
        })->download('xlsx');

        
    }
}
