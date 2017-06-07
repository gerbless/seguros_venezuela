<?php

namespace App\Http\Controllers\backEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Http\Requests\usuarios\usuariosCreateRequest;
use App\Model\menuModel;
use App\Model\rolesModel;
class UsuariosController extends Controller
{

    public function __construct(Request $request){
        $this->middleware('auth');
        if (!$request->ajax()) abort(403);
        
    }

    public function index()
    {
        $usuarios=User::all();
        return view('back_end.usuarios.index')->with("usuarios",$usuarios);
    }
    
    public function create()
    {
        $supervisor=User::where('status_id',1)->pluck('name','id');
        return view('back_end.usuarios.create',compact('supervisor'));
    }

    public function store(usuariosCreateRequest $request)
    {
            $result=User::create($request->all());
            if($result)
            {
                return response()->json(array('menj'=>'Usuario Registrado Correctamente','ruta'=>'listado-usuarios','tipo'=>'aprobado'));
            }else{
                return response()->json(array('menj'=>'Hubo un error vuelva a intentarlo','tipo'=>'rechazado'));
            }
    }
    
    public function edit($usuario)
    {
            $contador=count($usuario);

            if($contador>0){
                $supervisor=User::where('status_id',1)->pluck('name','id');
                return view("back_end.usuarios.edit")
                    ->with("supervisor",$supervisor)
                    ->with("usuario",$usuario);
            }
            else
            {
                return view("mensajes.msj_rechazado")->with("msj","el usuario solicitado no existe!!!");
            }
    }
    
    public function update(request $request,$usuario)
    {
        if($request->ajax())
        {
            if($request->frm=="datos-clave" && $request->password==$usuario->password)
            {
                return response()->json(array('menj'=>'No se pudo actualizar la clave','tipo'=>'rechazado'));
            }

            $usuario->fill($request->all());
            $result=$usuario->save();
            if($result){
                return response()->json(array('menj'=>'Usuario Registrado Correctamente','ruta'=>'listado-usuarios','tipo'=>'aprobado'));
                //return view("mensajes.msj_correcto")->with("msj","Usuario Registrado Correctamente");
            }
            else
            {
                return response()->json(array('menj'=>'Hubo un error vuelva a intentarlo','tipo'=>'rechazado'));
            }
        }
    }

    public function editPerfil($usuario)
    {
        $contador=count($usuario);
        $roles = $usuario->roles->where('status_id',1);
        $menus=menuModel::where('status_id',1)->orderBy('orden', 'asc')->get();
        
        foreach ($menus as $menu) {
            $submenus[$menu->nombre]=menuModel::find($menu->id)->submenu;
            for($i=0;$i<count($submenus[$menu->nombre]);$i++){
                foreach ($roles as $role) {
                    if($role->submenu_id==$submenus[$menu->nombre][$i]->id){
                        $submenus[$menu->nombre][$i]->ck="true";
                    }
                }
            }
        }

        if($contador>0){
            return view("back_end.usuarios.perfil",compact('usuario','menus','submenus'));
        }
        else
        {
            return view("mensajes.msj_rechazado")->with("msj","el usuario solicitado no existe!!!");
        }
    }
    
    public function updatePerfil(request $request)
    {
      if($request->accion=="false"){
          rolesModel::where('user_id',$request->idUsuario->id)
              ->where('submenu_id',$request->idSubmenu)
              ->update(['status_id'=>2]);
      }else{
         $encontro=0;
         foreach($request->idUsuario->roles as $role){
             if($role->submenu_id==$request->idSubmenu)
             {
                 $encontro=1;
                 rolesModel::where('user_id',$request->idUsuario->id)
                     ->where('submenu_id',$request->idSubmenu)
                     ->update(['status_id'=>1]);
             }
         }

          if($encontro==0)
          {
              rolesModel::create([
                  'status_id'=>1,
                  'user_id'=>$request->idUsuario->id,
                  'submenu_id'=>$request->idSubmenu
              ]);
          }

      }


    }
}
