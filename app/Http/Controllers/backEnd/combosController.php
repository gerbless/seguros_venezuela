<?php

namespace App\Http\Controllers\backEnd;



use App\Model\ciudadesModel;
use App\Model\municipiosModel;
use Barryvdh\Debugbar\Middleware\Debugbar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\tpfnivel1Model;
use App\Model\tpfnivel2Model;
use App\Model\tpfnivel3Model;
use App\Model\estadoModel;
use App\Model\campanaModel;
use App\Model\ramosModel;
use App\Model\productosModel;
use App\Model\planesModel;
use App\Model\tarifarioModel;
class combosController extends Controller
{
    protected  $id;
    protected  $mas;
    public function __construct(request $request)
    {
           $this->id=$request->id;
           $this->mas=$request;
           if(!$request->ajax()) abort(403);
    
    }

    public function getTpfnivel1()
    {
        $data=tpfnivel1Model::find($this->id)->tpfnivel2->where('status_id',1);
        return response()->json($data);
    }

    public function getTpfnivel2()
    {
        $data=tpfnivel2Model::find($this->id)->tpfnivel3->where('status_id',1);
        return response()->json($data);
    }

    public function getTpfnivel3()
    {
        $data=tpfnivel3Model::find($this->id)->tpfnivel4->where('status_id',1);
        return response()->json($data);
    }

    public function getCiudad()
    {
        $data=estadoModel::find($this->id)->ciudades->where('status_id',1);
        return response()->json($data);
    }

    public function getMunicipio()
    {
        $data=estadoModel::find($this->id)->municipio->where('status_id',1);
        return response()->json($data);
    }

    public function getRamo()
    {
        $data =campanaModel::find($this->id)->ramos->where('status_id',1);
        return response()->json($data);
    }

    public function getProducto()
    {
        $data =ramosModel::find($this->id)->productos->where('status_id',1);
        return response()->json($data);
    }

    public function getPlan(request $request)
    {
      //  \Debugbar::info(intval($request->plan_cliente));

        if($request->plan_cliente=="undefined")
        {
            $data =productosModel::find($this->id)->planes->where('status_id',1);
        }else{
            $data=planesModel::where('producto_id',$this->id)->whereIn('id',explode(',',$request->plan_cliente))->active()->get();
        }
        return response()->json($data);
    }

    public function getCoberturas()
    {
        $data =planesModel::find($this->id)->coberturas->where('status_id',1);
        return response()->json($data);
    }

    public function getTarifario(request $request)
    {
        $data =tarifarioModel::where("campana_id",$this->id)
            ->where("campana_id",$request->id)
            ->where("ramo_id",$request->idRamo)
            ->where("producto_id",$request->idProducto)
            ->where("plan_id",$request->idPlan)
            ->where("frecuencia_pago_id",$request->idFrecuencia)
            ->where('status_id',1)->get();
        return response()->json($data);
    }

    public function getAutocombo(request $request)
    {
        switch($request->funcion)
        {
        case "Ciudad":
            $data=ciudadesModel::where('estado_id',$this->id)->select('nb_ciudad as nombre','id as valor')->get();
            break;

        case "Municipio":
           $data = municipiosModel::where('estado_id',$this->id)->select('nb_municipio as nombre','id as valor')->get();
            break;
        }

        return response()->json($data);

    }

    public function getcuentaCorriente($banco)
    {
        return $banco->cuenta." ".$banco->codigo;
    }

    public function getPlanSelect2(request $request)
    {
        $data=planesModel::where([
            ['producto_id',$request->id_producto],
            ['nb_plan','like',$request->nom_plan."%"]
        ])
            ->pluck('nb_plan','id');

        foreach ($data as $id=>$plan)
        {
            $planes[]=['id' => $id, 'text' => $plan];
        }

        return response()->json($planes);

        

    }



}
