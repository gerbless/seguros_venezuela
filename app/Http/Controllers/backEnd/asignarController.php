<?php

namespace App\Http\Controllers\backEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\clientesModel;
class asignarController extends Controller
{
    public function __construct(request $request)
    {
        if (!$request->ajax()) abort(403);

    }
    
    public function store(request $request)
    {
        if(!strpos($request->idcli,'-')){
            clientesModel::find($request->idcli)->update(['status_id'=>3,'users_id'=>$request->idagente]);
            return $request->idcli;
        }else{
            $datas=explode("-", $request->idcli);
            foreach ($datas as $data){
                clientesModel::find($data)->update(['status_id'=>3,'users_id'=>$request->idagente]);
            }
            return response()->json($datas);
        }


    }
}
