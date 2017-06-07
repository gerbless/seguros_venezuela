<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\backEnd\HomeController;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Session;
USE Redirect;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'logout']);
    }

    //login

    protected function getLogin()
    {
        return view("login");
    }

 

    protected function redirectTo()
    {
        if(\Auth::user()->supervisor_users_id==null && \Auth::user()->tipo=="AGENTES")
        {
            abort(500,"Su usuario no tiene supervisor asignado, por favor contacte al administrador.");
        }else{
            $this->redirectTo = 'home';
            return $this->redirectTo;
        }
       // $home=new HomeController();
        // return $home->index();
    }



}
