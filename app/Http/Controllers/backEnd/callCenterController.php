<?php

namespace App\Http\Controllers\backEnd;

use App\Model\schemaCLienteModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\tpfnivel1Model;
use App\Model\clientesModel;
use App\Model\contactosModel;
use App\Model\toquesTelefonoModel as toques;
use App\Model\toquesModel as     maxToques;
use App\Model\aperturasModel;
use App\Model\reglaModel;
use App\Model\submenuModel;
use App\User;
use App\Model\campanaModel;
use App\Model\planesModel;
class callCenterController extends Controller
{
    protected $acction;
    protected $muestra;

    public function __construct(request $request)
    {
        $this->acction = $request->decodedPath();
        if (!$request->ajax()) abort(403);
    }

    public function index()
    {
        $agentes=null;
        $acceso=submenuModel::where('ruta',$this->acction)->first();
        if($this->acction=="clientes-asignar"):$agentes=User::activo()->agentes()->pluck('name','id'); endif;
        if(\Auth::user()->tipo=="AGENTES"){
            $data = \Auth::user()->clientes()->where('status_id',$acceso->status_id)->orderBy('updated_at','desc')->get();
        }else{
            $data =clientesModel::with('lotes')->where('status_id',$acceso->status_id)->orderBy('lote_id','asc')->limit(3000)->get();
        }
        return view('back_end.gestion.index', compact('agentes','data'))
            ->with('ruta_actual',$this->acction)
            ->with('carpeta',$acceso->nombre)
            ->with('icon',$acceso->icon);
    }

    public function edit($gestionar)
    {
        $campana = campanaModel::active()->pluck('nb_campana', 'id');
        $plan=planesModel::active()->pluck('nb_plan', 'id');
        $tpfnivel1 = tpfnivel1Model::pluck('nb_tpfnivel1', 'id');
        $maxToques = maxToques::all('max_toques')->first();
        $campos =schemaCLienteModel::bd()->table('clientes')->column('telefono')->get();
        for ($i = 1; $i <= $campos->count(); $i++) {
            $data[$gestionar["telefono" . $i]] = $gestionar->toquesTelefono()->find($gestionar["telefono" . $i]);
            if ($data[$gestionar["telefono" . $i]] != null) {
                $toques[$gestionar["telefono" . $i]]['toques'] = $data[$gestionar["telefono" . $i]]->toques;
                $toques[$gestionar["telefono" . $i]]['max_toques'] = $maxToques->max_toques;
                $toques[$gestionar["telefono" . $i]]['readonly'] = "";
                if ($toques[$gestionar["telefono" . $i]]['toques'] >= 3) $toques[$gestionar["telefono" . $i]]['readonly'] = "disabled";
            }
        }
        return view('back_end.gestion.edit', compact('gestionar', 'tpfnivel1', 'toques', 'campos','campana','plan'));
    }

    public function update(request $request)
    {
        //VALIDO QUE EL CAMPO SEA DISTINTO PARA PROCESAR PETICIÓN
        if ($request->idCliente[$request->campo] != $request->dato) {
            //EN CASO DE QUE SEA UN TELEFONO VALIDO QUE O TENGA REGISTROS GESTIONADOS ANTES DE ACTUALIZAR
            if(toques::where('id',$request->idCliente[$request->campo])->count()==0)
            {
                //REALIZO LA ACTUALIZACION DEL TELEFONO O CUALQUIER OTRO CAMPO REQUERIDO DEL CLIENTE
                clientesModel::where('id', $request->idCliente->id)->update([$request->campo => $request->dato]);

                return response()->json(array('menj'=>'Actualización realizada con exito.','tipo'=>'aprobado'));
            }else{
                return response()->json(array('menj'=>'El Nro. ya cuenta con registros gestionados.','accion'=>1,'campo'=>$request->idCliente[$request->campo],'ruta'=>'listado-usuarios','tipo'=>'rechazado'));
            }
        }
    }
    /**
     * 1- SI POR ALGUNA RAZÓN LAS VALIDACIONES JS PERMITAN PASAR EL TELÉFONO EN BLANCO AUTOMATICAMENTE SE LE INDICA AL USUARIO QUE OCURRIO
     * SE PROCEDE A ENVIAR EL MENSAJE Y SE ENVIA UNA ACCIN JS QUE PERMITE ABRIR LOS CAMPOS NUEVAMENTE PARA QUE LO INTENTE DE NUEVO
     * PROCESO SE REPITE N... CANTIDAD DE VECES HASTA QUE SE LOGRE HACER LA TIPIFICACION
     * 2- PROCEDEMOS A CONSULTAR LA REGLA DE NEGOCIO QUE APLICA LA TIPIFICACIÓN SELECCIONADA
     * 3- VALIDAMOS QUE EFECTIVAMENTE SE ENCUENTRE CREADA UNA REGLA DE NEGOCIO PARA LA TIPIFICACIÓN SELECCIONADA
     * 4- CREO EL REGISTRO DE LA TIPIFICACION Y DEVUELVO SU ID
     * 5- LE INDICO LA REGLA DE NEGOCIO A LA QUE APLICA DICHA TIPIFICACIÓN
     * 6- CONSULTO EL NUMERO DE TOQUES QUE TIENE ESE NRO. DE TELEFONO
     * 7- CREO EL TELEFONO EN LA TABLA DE TOQUES SI NO EXISTE, EN CASO DE QUE EXISTA SIMPLEMENTE LE INCREMENTO UN TOQUE
     * 8- ACTUALIZO EL CLIENTE PARA ADJUNTAR LA REGLA DE NEGOCIOS Y MOVER A LA CARPETA QUE LE CORRESPONDE
     * 9- DETERMINO SI LA REGLA DE NEGOCIO SOLICITA UN CIERRE AUTOMÁTICO DEL CLIENTE ó CIERRE POR SUPERAR CONTACTOS GLOBALES
     * */
    public function store(request $request,$cliente)
    {
       /*1*/ if($request->telefono=="") :
            return response()->json(array('menj'=>'Disculpe, No encontramos Nro. teléfonico, por favor intente tipificar nuevamente el registro','tipo'=>'rechazado','tipo'=>'rechazado','no_nro'=>'no_nro'));
        endif;

        /*2*/
        if ($request->tpfnivel3_id==""){ $tpfnivel3=null; }else{$tpfnivel3=$request->tpfnivel3_id;}
        if ($request->tpfnivel4_id==""){$tpfnivel4=null;} else {$tpfnivel4=$request->tpfnivel4_id;}
        $regla=reglaModel::where('tpfnivel1_id',$request->tpfnivel1_id)
            ->where('tpfnivel2_id',$request->tpfnivel2_id)
            ->where('tpfnivel3_id',$tpfnivel3)
            ->where('tpfnivel4_id',$tpfnivel4)
            ->where('status_id','!=',2)
            ->select('cierre','status_id','accion','nb_accion')
            ->first();
        /*3*/
        if($regla->count()>0)
        {
            $regla->nb_accion=str_replace('/','/'.$request->telefono.'',$regla->nb_accion);
            /*4*/contactosModel::create($request->all());
            /*5*/$contactoid=contactosModel::all('id')->last();
            contactosModel::find($contactoid->id)->update(['status_id'=>$regla->status_id]);
            /*6*/$nroToque = toques::where('id', $request->telefono)->count();
            /*7*/($nroToque== 0) ? toques::create(["id" => $request->telefono, "toques" => 1, "clientes_id" => $request->clientes_id, "status_id" => 1]) : toques::where('id', $request->telefono)->increment('toques');
            /*8*/clientesModel::where('id',$request->clientes_id)->update(['status_id'=>$regla->status_id]);
            /*9*/if($regla->status_id !=$this->cierre() && $regla->cierre=="SI"):
                      $this->cierreAutomatico($cliente,$regla->status_id);
                    else:
                      $this->cierreNrosAgotados($cliente);
                endif;

            return response()->json(array('menj'=>'Actualización realizada con exito.','ruta'=>$request->ruta,'accion'=>$regla->accion,'nb_accion'=>$regla->nb_accion,'id'=>$request->clientes_id,'tipo'=>'aprobado'));
        }else{
            return response()->json(array('menj'=>'No se encontro regla de negocio asociada para la tipificación seleccionada','tipo'=>'rechazado'));
        }

    }

   //APERTURAR TELEFONO EN CASO DE QUE LA REGLA DE APERTURA ASI LO REQUIERA
    public function aperturas(request $request)
    {
        $tpfnivel2=str_replace(':eliminame:','',$request->tpfnivel2);
        $tpfnivel3=str_replace(':eliminame:','',$request->tpfnivel3);
        $tpfnivel4=str_replace(':eliminame:','',$request->tpfnivel4);
        if (strlen($tpfnivel2)==0) $tpfnivel2=null;
        if (strlen($tpfnivel3)==0) $tpfnivel3=null;
        if (strlen($tpfnivel4)==0) $tpfnivel4=null;
        $aperturas=aperturasModel::where('tpfnivel1_id',$request->tpfnivel1)
            ->where('tpfnivel2_id',$tpfnivel2)
            ->where('tpfnivel3_id',$tpfnivel3)
            ->where('tpfnivel4_id',$tpfnivel4)
            ->select('toque_apertura')
            ->get();
        return response()->json($aperturas);
     }
    
    
    public function show($cliente)
    {
        $contactos=clientesModel::find($cliente->id)->contactos()->orderBy('created_at', 'desc')->get();
        return  view('back_end.gestion.historia',compact('contactos','cliente'));
    }


    /**---------------------DESCRIPCIÓN --------------------------------------
     * METODO QUE SE ENCARGA DE CONTROLAR LA CANTIDAD DE NUMEROS QUE EL CLIENTE
     * TIENE EN LA BASE DE DADOS (DISTINTOS A NULO)
     * PARA VERIFICAR SI EL CLIENTE SUPERÓ EL TOTAL DE TOQUES PERMITIDOS
     * Y CERRARLO AUTOMÁTICAMENTE POR LA BASE DE DATOS <(MOVER A STATUS NO VENTAS).
     *  /*
             * 1-  CONSULTAMOS LA CANTIDAD DE TOQUES PARAMETRIZADOS EN LA BASE DE DATOS
             * 2-  RECUPERO LA CANTDAD DE CAMPOS TELEFONOS QUE TENEMOS EN LA APLICACION
             * 3-  VARIANLE QUE ALMACENA LA CANTIDAD DE NUMEROS DE TELEFONOS QUE NO ESTAN EN BLANCO
             * 4-  RECORREMOS PARA CONTAR CUALES SON LOS TELEFONOS REALES
             * 5-  CUANTIFICO CUANTOS TOQUES DEBE TENER EL CLIENTE POR TODOS SUS TELEFONOS PARA SER CERRADO
             * 6-  CONSULTO LA CANTIDAD DE TOQUES POR TODOS LOS TELEFONOS DEL CLIENTES (TOTAL GLOBAL DE TOQUES)
             * 7-  PROCEDEMOS A CERRAR EL CLIENTE PARA QUE NO PUEDA SER GESTIONADO NUEVAMENTE
     * */
    private function cierreNrosAgotados($cliente)
    {
        /*1*/ $maxToques = maxToques::all('max_toques')->first();
        /*2*/ $campos =schemaCLienteModel::bd()->table('clientes')->column('telefono')->get();
        /*3*/ $canNro=0;
        /*4*/for ($i = 1; $i <= $campos->count(); $i++) {if($cliente["telefono" . $i]!=null) $canNro++;}
        /*5*/$totalParaBloqueo=($maxToques->max_toques * $canNro);
        /*6*/$contactosCliente=toques::where('clientes_id',$cliente->id)->sum('toques');
        /*7*/if ($contactosCliente >=$totalParaBloqueo):
               clientesModel::where('id',$cliente->id)->update(['status_id' => $this->cierre()]);
            endif;
    }

    /**
     * DETERMINA SI LA REGLA DE NEGOCIO SOLICITA EL CIERRE AUTOMATICO
     * DEL CLIENTE. ES EMPLEADA PARA CUANDO EL STATUS DE CIERRE DIFIERE
     * (PUEDE DIFERIR EN CASO DE QUE SE QUIERA ESPECIFICAR EL MOTIVO DE LA NO VENTA)
     *  @ $reglaStatus = VALOR ASIGNADO DESDE LA REGLA DE NEGOCIOS
     * */
    private function cierreAutomatico($cliente,$reglaStatus)
    {
        clientesModel::where('id',$cliente->id)->update(['status_id' => $reglaStatus]);
    }

}
