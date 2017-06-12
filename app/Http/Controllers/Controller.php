<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    public  $rutaviewTM="back_end.tablas_maestras.";
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $mensaje=array();
    
    //RETORNAR EL ID QUE PERMITE CERRAR UN CASO PARA QUE NO SEA FESTIONADO
    public function cierre()
    {
        return 8;
    }

    public function mensajeErrorQuery($e){


        return $this->mensaje=array(
            "menj"=>"Error en algunos de los registro suministrado, verifique la información.
                <br>
               <b>Nro. Error:</b> ".$e->getCode()." <br>
                <b>Mensaje:</b> ".$e->getMessage()." <br>
                ",
            "tipo"=>"rechazado",
            "hinabilty"=>"N",
        );
    }
}
