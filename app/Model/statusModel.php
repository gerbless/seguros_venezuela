<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class statusModel extends Model
{
    protected $table="status";
    protected $fillable=["nb_status","id"];
    
    public function menu(){
        return $this->hasMany(menuModel::class,'status_id');
    }

    public function submenu(){
        return $this->hasMany(submenuModel::class,'status_id');
    }

    public function roles(){
        return $this->hasMany(rolesModel::class,'status_id');
    }

    public function sexos(){
        return $this->hasMany(sexosModel::class,'status_id');
    }


    public function clientes(){
        return $this->hasMany(clientesModel::class,'status_id');
    }

    public function tpfnivel1(){
        return $this->hasMany(tpfnivel1Model::class,'status_id');
    }

    public function tpfnivel2(){
        return $this->hasMany(tpfnivel2Model::class,'status_id');
    }

    public function tpfnivel3(){
        return $this->hasMany(tpfnivel3Model::class,'status_id');
    }

    public function tpfnivel4(){
        return $this->hasMany(tpfnivel4Model::class,'status_id');
    }

    public function contactos(){
        return $this->hasMany(contactosModel::class,'status_id');
    }

    public function toquesTelefono(){
        return $this->hasMany(toquesTelefonoModel::class,'status_id');
    }

    public function toques(){
        return $this->hasMany(toquesModel::class,'status_id');
    }

    public function aperturas(){
        return $this->hasMany(aperturasModel::class,'status_id');
    }

    public function regla(){
        return $this->hasMany(reglaModel::class,'status_id');
    }

    public function direcciones(){
        return $this->hasMany(direccionesModel::class,'status_id');
    }
    
    public function polizaPagador(){
        return $this->hasMany(polizaPagadorModel::class,'status_id');
    }
    
    public function mediosPago(){
        return $this->hasMany(mediosPagoModel::class,'status_id');
    }

    public function beneficiarios(){
        return $this->hasMany(beneficiariosModel::class,'status_id');
    }

    public function herederosLegales(){
        return $this->hasMany(herederosLegalesModel::class,'status_id');
    }

    public function parentesco(){
        return $this->hasMany(parentescoModel::class,'status_id');
    }

    public function tipoBeneficiario(){
        return $this->hasMany(tipoBeneficiario::class,'status_id');
    }

    public function datosRiesgoAsegurable(){
        return $this->hasMany(datosRiesgoAsegurable::class,'status_id');
    }

    public function tipoRiesgo(){
        return $this->hasMany(tipoRiesgo::class,'status_id');
    }

    public function nivelEducativo(){
        return $this->hasMany(nivelEducativoModel::class,'status_id');
    }

    public function bancos(){
        return $this->hasMany(bacosModel::class,'status_id');
    }

    public function scopeUsables($query)
    {
        return $query->whereIn('id',[1,2]);
    }
}
