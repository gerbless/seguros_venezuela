<?php

namespace App\Http\Controllers\backEnd;
use App\Http\Controllers\Controller;
use App\Model\submenuModel;
use App\Model\menuModel;
use Redirect;
use App\Model\statusModel;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public  function index()
    {
       if(\Auth::user()->roles->where('status_id',1)->count()<=0) abort(406);
        $menus=menuModel::where('status_id',1)->orderBy('orden', 'asc')->get();
        return view('home',compact('menus'))
            ->with('botones',$this->perfilRoles())
            ->with('total_clientes',$this->nroRegitrosStatus());
    }

    private function perfilRoles()
    {
        $roles = \Auth::user()->roles->where('status_id',1);
        foreach ($roles as $role) {
            $botones[submenuModel::find($role->submenu_id)->menu->nombre][]=submenuModel::find($role->submenu_id);
        }
        return $botones;
    }

    public function nroRegitrosStatus()
    {
        $status=statusModel::all();
        foreach ($status as $statu)
            {
            if(\Auth::user()->tipo=="AGENTES"){
                $total_clientes[$statu->id]=statusModel::find($statu->id)->clientes()->where('users_id',\Auth::user()->id)->count();
            }else{
              $total_clientes[$statu->id]=statusModel::find($statu->id)->clientes()->count();
            }
        }
        return $total_clientes;
    }

    public function logout()
    {
        \Auth::logout();
        return Redirect::to('/');
    }
}
