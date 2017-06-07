<?php

namespace App;

use App\Model\agentesCampanasModel;
use App\Model\clientesModel;
use App\Model\contratantesModel;
use App\Model\postModel;
use App\Model\rolesModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password' ,'tipo','status_id','documento','supervisor_users_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];


    public function setPasswordAttribute($valor){
        if(!empty($valor)){
            //dd($valor);
            $this->attributes['password'] = \Hash::make($valor);
        }
    }
    
    public function roles(){
        return $this->hasMany(rolesModel::class,'user_id');
    }

    public function contactos(){
        return $this->hasMany(contactosModel::class);
    }

    public function clientes(){
        return $this->hasMany(clientesModel::class,'users_id');
    }

    public function status(){
        return $this->belongsTo(statusModel::class,'status_id');
    }


    public function supervisorUsersVenta(){
        return $this->hasMany(contratantesModel::class,"supervisor_users_id");
    }

    public function vendedorUsersVenta(){
        return $this->hasMany(contratantesModel::class,"vendedor_users_id");
    }

    public function agentescampanas(){
        return $this->hasMany(agentesCampanasModel::class,'user_id');
    }
    

    public function scopeactivo($query)
    {
        return $query->where('status_id',1);
    }

    public function scopeagentes($query)
    {
        return $query->where('tipo','AGENTES');
    }


}
