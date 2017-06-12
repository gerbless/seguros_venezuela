<?php

namespace App\Http\Controllers\backEnd;


use App\Http\Controllers\Controller;
use App\Model\actividadEconomicaCivilModel;
use App\Model\beneficiariosModel;
use App\Model\campanaModel;
use App\Model\ciudadesModel;
use App\Model\coberturasModel;
use App\Model\estadoModel;
use App\Model\loteXmlModel;
use App\Model\municipiosModel;
use App\Model\nivelEducativoModel;
use App\Model\OcupacionModel;
use App\Model\parentescoModel;
use App\Model\PolizaAseguradosModel;
use App\Model\polizaPagadorModel;
use App\Model\sponsorModel;
use App\Model\tomadorPolizaModel;
use Barryvdh\Debugbar\Middleware\Debugbar;
use DB;
use DOMDocument;
use Illuminate\Http\Request;
use App\Model\emisionXmlModel;
use App\Model\clientesModel;
class txtController extends Controller
{
    public function __construct(request $request)
    {
        // if((!$request->ajax()) && $request->decodedPath()!="descarga-xml")  abort(403);
    }

    public function index()
    {
        $campana = campanaModel::active()->pluck('nb_campana', 'id');
        $sponsor = sponsorModel::pluck('nb_sponsor', 'id');

        return view('back_end.reportes.txt', compact('campana', 'sponsor'));
    }

    public function store(request $request)
    {

        $xml = new DomDocument('1.0', 'UTF-8');
        $desde = date('Y-m-d', strtotime($request->desde));
        $hasta = date('Y-m-d', strtotime($request->hasta));
        $bancos = polizaPagadorModel::with('bancos')->where([
            ['poliza_pagador.campana_id',$request->campana]
        ])
            ->noTransferencias()
            ->whereNotNull('poliza_pagador.prima')
            ->whereBetween(DB::raw('DATE(poliza_pagador.ff_registro)'), [$desde, $hasta])
            ->active()
            ->distinct()
            ->select('banco_id')
           ->get();

        if($bancos->count()==0){
            $campana = campanaModel::active()->pluck('nb_campana', 'id');
            $sponsor = sponsorModel::pluck('nb_sponsor', 'id');
            return view('back_end.reportes.txt', compact('campana', 'sponsor', 'nom'));
        }


        $insurance_transactions = $xml->createElement('insurance_transactions');
        $xml->appendChild($insurance_transactions);
        $a1Attribute = $xml->createAttribute('xmlns:xsi');
        $a1Attribute->value = "http://www.w3.org/2001/XMLSchema-instance";
        $insurance_transactions->appendChild($a1Attribute);

        $a2Attribute = $xml->createAttribute('xsi:noNamespaceSchemaLocation');
        $a2Attribute->value = "RequestXSD.xsd";
        $insurance_transactions->appendChild($a2Attribute);
        $banks = $xml->createElement('banks');
        $insurance_transactions->appendChild($banks);
        $totalOperaciones = 0;
        foreach($bancos as $banco) {
            $bank = $xml->createElement('bank');
            $bankAttribute = $xml->createAttribute('code');
            $bankAttribute->value = $banco->banco_id;
            $bank->appendChild($bankAttribute);
            $banks->appendChild($bank);
            $bank_name = $xml->createElement('bank_name', $banco->bancos->nb_banco);
            $bank->appendChild($bank_name);

            $agencies = $xml->createElement('agencies');
            $bank->appendChild($agencies);
            $agency = $xml->createElement('agency');
            $agencies->appendChild($agency);
            $agencyAttribute = $xml->createAttribute('code');
            $agencyAttribute->value = 100;
            $agency->appendChild($agencyAttribute);
            $agency_name = $xml->createElement('agency_name', "OFICINA PRINCIPAL");
            $agency->appendChild($agency_name);
            //CREAR TRANSACTIONS DEL MISMO BANCO
            $transactions = $xml->createElement('transactions');
            $agency->appendChild($transactions);

            $datos = polizaPagadorModel::with('bancos')->where([
                ['poliza_pagador.campana_id',$request->campana],
                ['banco_id', $banco->banco_id],
            ])
                ->noTransferencias()
                ->whereNotNull('poliza_pagador.prima')
                ->whereBetween(DB::raw('DATE(poliza_pagador.ff_registro)'), [$desde, $hasta])
                ->otras()
                ->Adress('ddAsegurados','ddaPaises','ddaEstados','ddaCiudades','ddaMunicipios','poliza_asegurados')
                ->educacion('eduAsegurados','poliza_asegurados')
                ->ocupacion('OcupAsegurados','poliza_asegurados')
                ->actividadEconomica('ActivityEcoAsegurados','poliza_asegurados')
                ->Adress('ddPagador','ddpPaises','ddpEstados','ddpCiudades','ddpMunicipios','poliza_pagador')
                ->educacion('eduPagador','poliza_pagador')
                ->ocupacion('OcupPagador','poliza_pagador')
                ->actividadEconomica('ActivityEcoPagador','poliza_pagador')
                ->active()
                ->selectXml()
                ->get();

            foreach ($datos as $value)
            {
                //CREAMOS LOS DATOS DE LA transaction PARA CADA PAGADOR
                $transaction = $xml->createElement('transaction');
                $transactions->appendChild($transaction);
                $transactionAttribute = $xml->createAttribute('id');
                $transactionAttribute->value = $value->id;
                $transaction->appendChild($transactionAttribute);
                $type_code = $xml->createElement('type_code', "E");
                $transaction->appendChild($type_code);
                //CREAMOS LOS DATOS DE LA POLIZA
                $policy = $xml->createElement('policy');
                $transaction->appendChild($policy);
                $policyAttribute = $xml->createAttribute('id');
                $policyAttribute->value = $value->id;
                $policy->appendChild($policyAttribute);
                /** DATOS BASICOS DE LA POLIZA */
                $call_id = $xml->createElement('call_id', $value->operador_id);
                $policy->appendChild($call_id);
                $number = $xml->createElement('number', " ");
                $policy->appendChild($number);
                $certificate_number = $xml->createElement('certificate_number', $value->sucursal_id . str_pad($value->ramo_id, 2, 0, STR_PAD_LEFT) . $value->id);
                $policy->appendChild($certificate_number);
                $product_code = $xml->createElement('product_code', $value->producto_id);
                $policy->appendChild($product_code);
                $plan_code = $xml->createElement('plan_code', $value->plan_xml);
                $policy->appendChild($plan_code);
                $issue_date = $xml->createElement('issue_date', str_replace('-', '', $value->ff_registro));
                $policy->appendChild($issue_date);
                $channel_code = $xml->createElement('channel_code', $value->canal_id);
                $policy->appendChild($channel_code);
                $insurance_agency_code = $xml->createElement('insurance_agency_code', $value->sucursal_id);
                $policy->appendChild($insurance_agency_code);
                $insurance_agency_name = $xml->createElement('insurance_agency_name', "PRINCIPAL");
                $policy->appendChild($insurance_agency_name);
                $bank_user = $xml->createElement('bank_user', $value->userbanco);
                $policy->appendChild($bank_user);
                $AON_user = $xml->createElement('AON_user', $value->userproveedor);
                $policy->appendChild($AON_user);
                $currency_type = $xml->createElement('currency_type', $value->tipo_moneda_id);
                $policy->appendChild($currency_type);
                $frequency_code = $xml->createElement('frequency_code', $value->frecuencia_xml);
                $policy->appendChild($frequency_code);
                /** FIN DATOS BASICOS DE LA POLIZA */
                /** ************************** */
                /** DATOS DEL ASEGURADO DE LA POLIZA */
                $policy_holder = $xml->createElement('policy_holder');
                $policy->appendChild($policy_holder);
                /** ETIQUETA PERSONAS */
                $person = $xml->createElement('person');
                $policy_holder->appendChild($person);
                $name = $xml->createElement('name', $value->nb_nombre);
                $person->appendChild($name);
                $document_type_code = $xml->createElement('document_type_code', $value->nacionalidad_id);
                $person->appendChild($document_type_code);
                $document_number = $xml->createElement('document_number', $value->nu_documento);
                $person->appendChild($document_number);
                /** DIRECCION */
                $address = $xml->createElement('address');
                $person->appendChild($address);
                $country_code = $xml->createElement('country_code', $value->dDpais_id);
                $address->appendChild($country_code);
                $country_name = $xml->createElement('country_name',  $value->dDnb_pais);
                $address->appendChild($country_name);
                $state_code = $xml->createElement('state_code', $value->dDestado_id);
                $address->appendChild($state_code);
                $state_name = $xml->createElement('state_name', $value->dDnb_estado);
                $address->appendChild($state_name);
                $city_code = $xml->createElement('city_code', $value->dDciudad_id);
                $address->appendChild($city_code);
                $city_name = $xml->createElement('city_name', $value->dDnb_ciudad);
                $address->appendChild($city_name);
                $municipality_code = $xml->createElement('municipality_code', $value->dDmunicipio_id);
                $address->appendChild($municipality_code);
                $municipality_name = $xml->createElement('municipality_name',$value->dDnb_municipio);
                $address->appendChild($municipality_name);
                $parish = $xml->createElement('parish',$value->dDnb_parroquia);
                $address->appendChild($parish);
                $zip_code = $xml->createElement('zip_code', $value->dDco_postal);
                $address->appendChild($zip_code);
                $street = $xml->createElement('street', $value->dDtx_avenida_calle);
                $address->appendChild($street);
                $estate = $xml->createElement('estate', $value->dDtx_urbanizacion_direccion);
                $address->appendChild($estate);
                $building = $xml->createElement('building', $value->dDnb_edificio_casa);
                $address->appendChild($building);
                $floor = $xml->createElement('floor', $value->dDnu_piso);
                $address->appendChild($floor);
                $number = $xml->createElement('number', $value->dDnu_casa);
                $address->appendChild($number);
                $issue_date = $xml->createElement('issue_date', str_replace('-', '', $value->ff_registro));
                $person->appendChild($issue_date);
                /** DATOS CONFORME EL TIPO DE PERSONA */
                $type_person = $xml->createElement('type_person');
                $person->appendChild($type_person);
                $type_personAttribute = $xml->createAttribute('type');
                $type_personAttribute->value = $value->tipo_persona_id;
                $type_person->appendChild($type_personAttribute);
                if($value->tipo_persona_id == "N"){
                    $natural_person = $xml->createElement('natural_person');
                    $type_person->appendChild($natural_person);
                    $last_name = $xml->createElement('last_name', $value->nb_apellido);
                    $natural_person->appendChild($last_name);
                    $last_update_date = $xml->createElement('last_update_date', str_replace('-', '', $value->ff_ultima_actualizacion));
                    $natural_person->appendChild($last_update_date);
                    $education_degree_code = $xml->createElement('education_degree_code', $value->nivel_educativo_id);
                    $natural_person->appendChild($education_degree_code);
                    $education_degree_name = $xml->createElement('education_degree_name', $value->educacion_asegurado);
                    $natural_person->appendChild($education_degree_name);
                    $occuppation_code = $xml->createElement('occuppation_code', str_pad($value->ocupacion_id, 3, 0, STR_PAD_LEFT));
                    $natural_person->appendChild($occuppation_code);
                    $occuppation_name = $xml->createElement('occuppation_name', $value->ocupacion_asegurado);
                    $natural_person->appendChild($occuppation_name);
                    $birthdate = $xml->createElement('birthdate', str_replace('-', '', $value->ff_nacimiento));
                    $natural_person->appendChild($birthdate);
                    $gender = $xml->createElement('gender', $value->sexo_id);
                    $natural_person->appendChild($gender);
                    $marital_status = $xml->createElement('marital_status', $value->estadocivil_id);
                    $natural_person->appendChild($marital_status);
                    $children_number = $xml->createElement('children_number', $value->nu_hijos);
                    $natural_person->appendChild($children_number);
                    $email = $xml->createElement('email', $value->email);
                    $natural_person->appendChild($email);
                    $home_telephone1 = $xml->createElement('home_telephone1', $value->nu_tlf_hogar);
                    $natural_person->appendChild($home_telephone1);
                    $cellular_phone = $xml->createElement('cellular_phone', $value->nu_tlf_celular);
                    $natural_person->appendChild($cellular_phone);
                    $company_name = $xml->createElement('company_name', $value->nb_empresa);
                    $natural_person->appendChild($company_name);
                    $position = $xml->createElement('position', $value->nb_cargo);
                    $natural_person->appendChild($position);
                    $income_amount = $xml->createElement('income_amount', str_replace(",", ".", $value->nu_ingresos));
                    $natural_person->appendChild($income_amount);
                    $office_telephone1 = $xml->createElement('office_telephone1',str_pad($value->nu_tlf_oficina1,1,"", STR_PAD_LEFT));
                    $natural_person->appendChild($office_telephone1);
                    $office_telephone2 = $xml->createElement('office_telephone2',str_pad($value->nu_tlf_oficina2,1," ", STR_PAD_LEFT));
                    $natural_person->appendChild($office_telephone2);
                }else{
                    $legal_person = $xml->createElement('legal_person');
                    $type_person->appendChild($legal_person);
                    $last_update_date = $xml->createElement('last_update_date', str_replace('-', '', $value->ff_ultima_actualizacion));
                    $legal_person->appendChild($last_update_date);
                    $economy_activity_code = $xml->createElement('economy_activity_code', $value->activida_economica_id);
                    $legal_person->appendChild($economy_activity_code);
                    $economy_activity = $xml->createElement('economy_activity', $value->activity_asegurado);
                    $legal_person->appendChild($economy_activity);
                    $income_amount = $xml->createElement('income_amount', str_replace(",", ".", $value->nu_capital_promedio));
                    $legal_person->appendChild($income_amount);
                    $office_telephone1 = $xml->createElement('office_telephone1',str_pad($value->nu_tlf_oficina1,1," ", STR_PAD_LEFT));
                    $legal_person->appendChild($office_telephone1);
                    $office_telephone2 = $xml->createElement('office_telephone2',str_pad($value->nu_tlf_oficina2,1," ", STR_PAD_LEFT));
                    $legal_person->appendChild($office_telephone2);
                }


                /** FIN DATOS DE LOS ASEGURADOS */
                /** ************************** */
                /** DATOS DEL TOMADOR DE LA POLIZA */

                $policy_taker = $xml->createElement('policy_taker');
                $policy->appendChild($policy_taker);
                $person = $xml->createElement('person');
                $policy_taker->appendChild($person);
                $name = $xml->createElement('name', $value->panb_nombre);
                $person->appendChild($name);
                $document_type_code = $xml->createElement('document_type_code', $value->panacionalidad_id);
                $person->appendChild($document_type_code);
                $document_number = $xml->createElement('document_number', $value->panu_documento);
                $person->appendChild($document_number);
                /** DIRECCION */
                $address = $xml->createElement('address');
                $person->appendChild($address);
                $country_code = $xml->createElement('country_code', $value->dDppais_id);
                $address->appendChild($country_code);
                $country_name = $xml->createElement('country_name',  $value->dDpnb_pais);
                $address->appendChild($country_name);
                $state_code = $xml->createElement('state_code', $value->dDpestado_id);
                $address->appendChild($state_code);
                $state_name = $xml->createElement('state_name', $value->dDpnb_estado);
                $address->appendChild($state_name);
                $city_code = $xml->createElement('city_code', $value->dDpciudad_id);
                $address->appendChild($city_code);
                $city_name = $xml->createElement('city_name', $value->dDpnb_ciudad);
                $address->appendChild($city_name);
                $municipality_code = $xml->createElement('municipality_code', $value->dDpmunicipio_id);
                $address->appendChild($municipality_code);
                $municipality_name = $xml->createElement('municipality_name',$value->dDpnb_municipio);
                $address->appendChild($municipality_name);
                $parish = $xml->createElement('parish',$value->dDpnb_parroquia);
                $address->appendChild($parish);
                $zip_code = $xml->createElement('zip_code', $value->dDpco_postal);
                $address->appendChild($zip_code);
                $street = $xml->createElement('street', $value->dDptx_avenida_calle);
                $address->appendChild($street);
                $estate = $xml->createElement('estate', $value->dDptx_urbanizacion_direccion);
                $address->appendChild($estate);
                $building = $xml->createElement('building', $value->dDpnb_edificio_casa);
                $address->appendChild($building);
                $floor = $xml->createElement('floor', $value->dDpnu_piso);
                $address->appendChild($floor);
                $number = $xml->createElement('number', $value->dDpnu_casa);
                $address->appendChild($number);
                $issue_date = $xml->createElement('issue_date', str_replace('-', '', $value->ff_registro));
                $person->appendChild($issue_date);
                /** DATOS CONFORME EL TIPO DE PERSONA */
                $type_person = $xml->createElement('type_person');
                $person->appendChild($type_person);
                $type_personAttribute = $xml->createAttribute('type');
                $type_personAttribute->value = $value->ptipo_persona_id;
                $type_person->appendChild($type_personAttribute);
                if($value->ptipo_persona_id == "N"){
                    $natural_person = $xml->createElement('natural_person');
                    $type_person->appendChild($natural_person);
                    $last_name = $xml->createElement('last_name', $value->pnb_apellido);
                    $natural_person->appendChild($last_name);
                    $last_update_date = $xml->createElement('last_update_date', str_replace('-', '', $value->ff_ultima_actualizacion));
                    $natural_person->appendChild($last_update_date);
                    $education_degree_code = $xml->createElement('education_degree_code', $value->pnivel_educativo_id);
                    $natural_person->appendChild($education_degree_code);
                    $education_degree_name = $xml->createElement('education_degree_name', $value->educacion_pagador);
                    $natural_person->appendChild($education_degree_name);
                    $occuppation_code = $xml->createElement('occuppation_code', str_pad($value->pocupacion_id, 3, 0, STR_PAD_LEFT));
                    $natural_person->appendChild($occuppation_code);
                    $occuppation_name = $xml->createElement('occuppation_name', $value->ocupacion_pagador);
                    $natural_person->appendChild($occuppation_name);
                    $birthdate = $xml->createElement('birthdate', str_replace('-', '', $value->pff_nacimiento));
                    $natural_person->appendChild($birthdate);
                    $gender = $xml->createElement('gender', $value->psexo_id);
                    $natural_person->appendChild($gender);
                    $marital_status = $xml->createElement('marital_status', $value->pestadocivil_id);
                    $natural_person->appendChild($marital_status);
                    $children_number = $xml->createElement('children_number', $value->pnu_hijos);
                    $natural_person->appendChild($children_number);
                    $email = $xml->createElement('email', $value->pemail);
                    $natural_person->appendChild($email);
                    $home_telephone1 = $xml->createElement('home_telephone1', $value->pnu_tlf_hogar);
                    $natural_person->appendChild($home_telephone1);
                    $cellular_phone = $xml->createElement('cellular_phone', $value->pnu_tlf_celular);
                    $natural_person->appendChild($cellular_phone);
                    $company_name = $xml->createElement('company_name', $value->pnb_empresa);
                    $natural_person->appendChild($company_name);
                    $position = $xml->createElement('position', $value->pnb_cargo);
                    $natural_person->appendChild($position);
                    $income_amount = $xml->createElement('income_amount', str_replace(",", ".", $value->pnu_ingresos));
                    $natural_person->appendChild($income_amount);
                    $office_telephone1 = $xml->createElement('office_telephone1',str_pad($value->pnu_tlf_oficina1,1,"", STR_PAD_LEFT));
                    $natural_person->appendChild($office_telephone1);
                    $office_telephone2 = $xml->createElement('office_telephone2',str_pad($value->pnu_tlf_oficina2,1," ", STR_PAD_LEFT));
                    $natural_person->appendChild($office_telephone2);
                }else{
                    $legal_person = $xml->createElement('legal_person');
                    $type_person->appendChild($legal_person);
                    $last_update_date = $xml->createElement('last_update_date', str_replace('-', '', $value->ff_ultima_actualizacion));
                    $legal_person->appendChild($last_update_date);
                    $economy_activity_code = $xml->createElement('economy_activity_code', $value->pactivida_economica_id);
                    $legal_person->appendChild($economy_activity_code);
                    $economy_activity = $xml->createElement('economy_activity', $value->activity_pagador);
                    $legal_person->appendChild($economy_activity);
                    $income_amount = $xml->createElement('income_amount', str_replace(",", ".", $value->pnu_capital_promedio));
                    $legal_person->appendChild($income_amount);
                    $office_telephone1 = $xml->createElement('office_telephone1',str_pad($value->pnu_tlf_oficina1,1," ", STR_PAD_LEFT));
                    $legal_person->appendChild($office_telephone1);
                    $office_telephone2 = $xml->createElement('office_telephone2',str_pad($value->pnu_tlf_oficina2,1," ", STR_PAD_LEFT));
                    $legal_person->appendChild($office_telephone2);
                }
                /** FIN DATOS TOMADOR */
                /** ************************** */
                /** DATOS DEL PAGADOR DE LA POLIZA */

                $policy_payer = $xml->createElement('policy_payer');
                $policy->appendChild($policy_payer);
                $person = $xml->createElement('person');
                $policy_payer->appendChild($person);
                $name = $xml->createElement('name', $value->panb_nombre);
                $person->appendChild($name);
                $document_type_code = $xml->createElement('document_type_code', $value->panacionalidad_id);
                $person->appendChild($document_type_code);
                $document_number = $xml->createElement('document_number', $value->panu_documento);
                $person->appendChild($document_number);
                /** DIRECCION */
                $address = $xml->createElement('address');
                $person->appendChild($address);
                $country_code = $xml->createElement('country_code', $value->dDppais_id);
                $address->appendChild($country_code);
                $country_name = $xml->createElement('country_name',  $value->dDpnb_pais);
                $address->appendChild($country_name);
                $state_code = $xml->createElement('state_code', $value->dDpestado_id);
                $address->appendChild($state_code);
                $state_name = $xml->createElement('state_name', $value->dDpnb_estado);
                $address->appendChild($state_name);
                $city_code = $xml->createElement('city_code', $value->dDpciudad_id);
                $address->appendChild($city_code);
                $city_name = $xml->createElement('city_name', $value->dDpnb_ciudad);
                $address->appendChild($city_name);
                $municipality_code = $xml->createElement('municipality_code', $value->dDpmunicipio_id);
                $address->appendChild($municipality_code);
                $municipality_name = $xml->createElement('municipality_name',$value->dDpnb_municipio);
                $address->appendChild($municipality_name);
                $parish = $xml->createElement('parish',$value->dDpnb_parroquia);
                $address->appendChild($parish);
                $zip_code = $xml->createElement('zip_code', $value->dDpco_postal);
                $address->appendChild($zip_code);
                $street = $xml->createElement('street', $value->dDptx_avenida_calle);
                $address->appendChild($street);
                $estate = $xml->createElement('estate', $value->dDptx_urbanizacion_direccion);
                $address->appendChild($estate);
                $building = $xml->createElement('building', $value->dDpnb_edificio_casa);
                $address->appendChild($building);
                $floor = $xml->createElement('floor', $value->dDpnu_piso);
                $address->appendChild($floor);
                $number = $xml->createElement('number', $value->dDpnu_casa);
                $address->appendChild($number);
                $issue_date = $xml->createElement('issue_date', str_replace('-', '', $value->ff_registro));
                $person->appendChild($issue_date);
                /** DATOS CONFORME EL TIPO DE PERSONA */
                $type_person = $xml->createElement('type_person');
                $person->appendChild($type_person);
                $type_personAttribute = $xml->createAttribute('type');
                $type_personAttribute->value = $value->ptipo_persona_id;
                $type_person->appendChild($type_personAttribute);
                if($value->ptipo_persona_id == "N"){
                    $natural_person = $xml->createElement('natural_person');
                    $type_person->appendChild($natural_person);
                    $last_name = $xml->createElement('last_name', $value->pnb_apellido);
                    $natural_person->appendChild($last_name);
                    $last_update_date = $xml->createElement('last_update_date', str_replace('-', '', $value->ff_ultima_actualizacion));
                    $natural_person->appendChild($last_update_date);
                    $education_degree_code = $xml->createElement('education_degree_code', $value->pnivel_educativo_id);
                    $natural_person->appendChild($education_degree_code);
                    $education_degree_name = $xml->createElement('education_degree_name', $value->educacion_pagador);
                    $natural_person->appendChild($education_degree_name);
                    $occuppation_code = $xml->createElement('occuppation_code', str_pad($value->pocupacion_id, 3, 0, STR_PAD_LEFT));
                    $natural_person->appendChild($occuppation_code);
                    $occuppation_name = $xml->createElement('occuppation_name', $value->ocupacion_pagador);
                    $natural_person->appendChild($occuppation_name);
                    $birthdate = $xml->createElement('birthdate', str_replace('-', '', $value->pff_nacimiento));
                    $natural_person->appendChild($birthdate);
                    $gender = $xml->createElement('gender', $value->psexo_id);
                    $natural_person->appendChild($gender);
                    $marital_status = $xml->createElement('marital_status', $value->pestadocivil_id);
                    $natural_person->appendChild($marital_status);
                    $children_number = $xml->createElement('children_number', $value->pnu_hijos);
                    $natural_person->appendChild($children_number);
                    $email = $xml->createElement('email', $value->pemail);
                    $natural_person->appendChild($email);
                    $home_telephone1 = $xml->createElement('home_telephone1', $value->pnu_tlf_hogar);
                    $natural_person->appendChild($home_telephone1);
                    $cellular_phone = $xml->createElement('cellular_phone', $value->pnu_tlf_celular);
                    $natural_person->appendChild($cellular_phone);
                    $company_name = $xml->createElement('company_name', $value->pnb_empresa);
                    $natural_person->appendChild($company_name);
                    $position = $xml->createElement('position', $value->pnb_cargo);
                    $natural_person->appendChild($position);
                    $income_amount = $xml->createElement('income_amount', str_replace(",", ".", $value->pnu_ingresos));
                    $natural_person->appendChild($income_amount);
                    $office_telephone1 = $xml->createElement('office_telephone1',str_pad($value->pnu_tlf_oficina1,1,"", STR_PAD_LEFT));
                    $natural_person->appendChild($office_telephone1);
                    $office_telephone2 = $xml->createElement('office_telephone2',str_pad($value->pnu_tlf_oficina2,1," ", STR_PAD_LEFT));
                    $natural_person->appendChild($office_telephone2);
                }else{
                    $legal_person = $xml->createElement('legal_person');
                    $type_person->appendChild($legal_person);
                    $last_update_date = $xml->createElement('last_update_date', str_replace('-', '', $value->ff_ultima_actualizacion));
                    $legal_person->appendChild($last_update_date);
                    $economy_activity_code = $xml->createElement('economy_activity_code', $value->pactivida_economica_id);
                    $legal_person->appendChild($economy_activity_code);
                    $economy_activity = $xml->createElement('economy_activity', $value->activity_pagador);
                    $legal_person->appendChild($economy_activity);
                    $income_amount = $xml->createElement('income_amount', str_replace(",", ".", $value->pnu_capital_promedio));
                    $legal_person->appendChild($income_amount);
                    $office_telephone1 = $xml->createElement('office_telephone1',str_pad($value->pnu_tlf_oficina1,1," ", STR_PAD_LEFT));
                    $legal_person->appendChild($office_telephone1);
                    $office_telephone2 = $xml->createElement('office_telephone2',str_pad($value->pnu_tlf_oficina2,1," ", STR_PAD_LEFT));
                    $legal_person->appendChild($office_telephone2);
                }
                /** DATOS DE PAGO */
                $payment_means = $xml->createElement('payment_means');
                $policy_payer->appendChild($payment_means);
                $payment_mean = $xml->createElement('payment_mean');
                $payment_means->appendChild($payment_mean);
                $payment_mean_code = $xml->createElement('payment_mean_code', $value->cod_xml);
                $payment_mean->appendChild($payment_mean_code);
                $payment_mean_name = $xml->createElement('payment_mean_name', $value->nb_medio_pago);
                $payment_mean->appendChild($payment_mean_name);
                $payment_mean_number = $xml->createElement('payment_mean_number', str_replace('-', '', $value->nu_medio_pago));
                $payment_mean->appendChild($payment_mean_number);
                
                /** DATOS DE BENEFICIARIOS EN CASO DE MUERTE */
                $beneficiaries = $xml->createElement('beneficiaries');
                $policy->appendChild($beneficiaries);

                /** QUERY QUE CONSULTA A LOS BENEFICIARIOS */
                $beneficiarios=beneficiariosModel::where([
                    ["clientes_id",$value->cliente_id],
                    ["poliza_asegurado_id",$value->id]
                ])->active()->get();
                foreach($beneficiarios as $benefiarios) {
                    $beneficiary = $xml->createElement('beneficiary');
                    $beneficiaries->appendChild($beneficiary);
                    $legal_heir = $xml->createElement('legal_heir', $benefiarios->heredero_id);
                    $beneficiary->appendChild($legal_heir);
                    $person_type = $xml->createElement('person_type', $benefiarios->tipo_persona_id);
                    $beneficiary->appendChild($person_type);
                    $document_type_code = $xml->createElement('document_type_code', $benefiarios->nacionalidad_id);
                    $beneficiary->appendChild($document_type_code);
                    $document_number = $xml->createElement('document_number', $benefiarios->nu_documento);
                    $beneficiary->appendChild($document_number);
                    $name = $xml->createElement('name', $benefiarios->nb_nombre);
                    $beneficiary->appendChild($name);
                    $last_name = $xml->createElement('last_name', $benefiarios->nb_apellido);
                    $beneficiary->appendChild($last_name);
                    $birthdate = $xml->createElement('birthdate', str_replace('-', '', $benefiarios->ff_nacimiento));
                    $beneficiary->appendChild($birthdate);
                    $age = $xml->createElement('age', $benefiarios->edad);
                    $beneficiary->appendChild($age);
                    $parentesco = parentescoModel::find($benefiarios->parentesco_id);
                    $relationship_code = $xml->createElement('relationship_code', $parentesco->cod_xml);
                    $beneficiary->appendChild($relationship_code);
                    $beneficiary_type = $xml->createElement('beneficiary_type', $benefiarios->tipobeneficiario_id);
                    $beneficiary->appendChild($beneficiary_type);
                    $issue_date = $xml->createElement('issue_date', str_replace('-', '', $benefiarios->ff_registro));
                    $beneficiary->appendChild($issue_date);
                    $last_update_date = $xml->createElement('last_update_date', str_replace('-', '', $benefiarios->ff_ultima_actualizacion));
                    $beneficiary->appendChild($last_update_date);
                    /** QUERY PARA DEERMINAR LA COBERTURA DEL BENEFICIARIO */
                    $coverages = $xml->createElement('coverages');
                    $beneficiary->appendChild($coverages);
                    $cobertura = coberturasModel::where('plan_id', $value->plan_id)->where('caso_muerte', 1)->first();
                    $coverage = $xml->createElement('coverage');
                    $coverages->appendChild($coverage);
                    $code = $xml->createElement('code', $cobertura->cod_cml);
                    $coverage->appendChild($code);
                    $name = $xml->createElement('name', $cobertura->nb_cobertura);
                    $coverage->appendChild($name);
                    $porcentaje = (100 / $beneficiarios->count());
                    $percentage = $xml->createElement('percentage', round($porcentaje));
                    $coverage->appendChild($percentage);

                }
                /** DATOS DE PAGO */
                $receipt = $xml->createElement('receipt');
                $policy->appendChild($receipt);
                $number = $xml->createElement('number', $value->id);
                $receipt->appendChild($number);
                $begin_date = $xml->createElement('begin_date', str_replace('-', '', date('Y-m-d')));
                $receipt->appendChild($begin_date);
                $end_date = $xml->createElement('end_date', str_replace('-', '', date('Y-m-d')));
                $receipt->appendChild($end_date);
                $sent_date = $xml->createElement('sent_date', str_replace('-', '', date('Y-m-d')));
                $receipt->appendChild($sent_date);
                $last_charge_date = $xml->createElement('last_charge_date', str_replace('-', '', date('Y-m-d')));
                $receipt->appendChild($last_charge_date);
                $total_amount = $xml->createElement('total_amount', str_replace(',', '.', $value->prima));
                $receipt->appendChild($total_amount);
                $payment = $xml->createElement('payment');
                $receipt->appendChild($payment);
                $payment_mean_number = $xml->createElement('payment_mean_number', str_replace('-', '', $value->nu_medio_pago));
                $payment->appendChild($payment_mean_number);
                $insurance_account_number = $xml->createElement('insurance_account_number', 0);
                $payment->appendChild($insurance_account_number);
                $insurance_comission = $xml->createElement('insurance_comission', 1);
                $payment->appendChild($insurance_comission);
                $insurance_amount = $xml->createElement('insurance_amount', 0);
                $payment->appendChild($insurance_amount);
                $insurance_debit_transaction = $xml->createElement('insurance_debit_transaction', 0);
                $payment->appendChild($insurance_debit_transaction);
                $insurance_credit_transaction = $xml->createElement('insurance_credit_transaction', 0);
                $payment->appendChild($insurance_credit_transaction);
                $bank_account_number = $xml->createElement('bank_account_number', 0);
                $payment->appendChild($bank_account_number);
                $bank_comission = $xml->createElement('bank_comission', 0);
                $payment->appendChild($bank_comission);
                $bank_amount = $xml->createElement('bank_amount', 0);
                $payment->appendChild($bank_amount);
                $bank_ins_debit_transaction = $xml->createElement('bank_ins_debit_transaction', 0);
                $payment->appendChild($bank_ins_debit_transaction);
                $bank_credit_transaction = $xml->createElement('bank_credit_transaction', 0);
                $payment->appendChild($bank_credit_transaction);
                $reinsurance_account_number = $xml->createElement('reinsurance_account_number', 0);
                $payment->appendChild($reinsurance_account_number);
                $reinsurance_comission = $xml->createElement('reinsurance_comission', 0);
                $payment->appendChild($reinsurance_comission);
                $reinsurance_amount = $xml->createElement('reinsurance_amount', 0);
                $payment->appendChild($reinsurance_amount);
                $reinsurance_ins_debit_transaction = $xml->createElement('reinsurance_ins_debit_transaction', 0);
                $payment->appendChild($reinsurance_ins_debit_transaction);
                $reinsurance_credit_transaction = $xml->createElement('reinsurance_credit_transaction', 0);
                $payment->appendChild($reinsurance_credit_transaction);
                $aon_account_number = $xml->createElement('aon_account_number', 0);
                $payment->appendChild($aon_account_number);
                $aon_comission = $xml->createElement('aon_comission', 0);
                $payment->appendChild($aon_comission);
                $aon_amount = $xml->createElement('aon_amount', 0);
                $payment->appendChild($aon_amount);
                $aon_ins_debit_transaction = $xml->createElement('aon_ins_debit_transaction', 0);
                $payment->appendChild($aon_ins_debit_transaction);
                $aon_credit_transaction = $xml->createElement('aon_credit_transaction', 0);
                $payment->appendChild($aon_credit_transaction);
                $cod_bloqueo = $xml->createElement('cod_bloqueo', str_replace('-', '', date('Y-m-d')));
                $payment->appendChild($cod_bloqueo);
                $bank_charge_date = $xml->createElement('bank_charge_date', str_replace('-', '', date('Y-m-d')));
                $payment->appendChild($bank_charge_date);
                $exchage_rate = $xml->createElement('exchage_rate', 0);
                $payment->appendChild($exchage_rate);

                $comments = $xml->createElement('comments', 0);
                $transaction->appendChild($comments);
                $totalOperaciones++;
                $misD[$value->idPagador]=$value->cliente_id;
            }

        }

        $total_operations = $xml->createElement('total_operations', $totalOperaciones);
        $insurance_transactions->appendChild($total_operations);

        $xml->formatOutput = true;  //poner los string en la variable $strings_xml:
        $strings_xml = $xml->saveXML();
        $sponsor = sponsorModel::find($request->sponsor);
        $lote = loteXmlModel::all()->first();
        $campana = campanaModel::find($request->campana);
        loteXmlModel::where('id', 1)->increment('nu_lote');
        $nom = 'DIREC_' . $sponsor->nb_sponsor . '_' . date('dmY', strtotime($desde)) . '_' . $campana->nb_campana . '_' . date('dmY', strtotime($hasta)) . '_' . $lote->nu_lote . '_EMIS.xml';
        $xml->save($nom);


    if($totalOperaciones > 0){
        foreach (array_unique($misD) as $item=>$value)
        {
            $ase=PolizaAseguradosModel::where('cliente_id',$value)->get();
            $paga=polizaPagadorModel::find($item);

            $poliza['polizas'][]=array(
                'pagador'=>$paga->toArray(),
                'asegurados'=>$ase->toArray()
            );

            polizaPagadorModel::where('id',$item)->update(['status_id' => 12]);
            clientesModel::where('id',$value)->update(['status_id' => 12]);
            PolizaAseguradosModel::where('cliente_id',$value)->update(['status_id' => 12]);
            beneficiariosModel::where('clientes_id',$value)->update(['status_id' => 12]);
        }


        emisionXmlModel::create([
            "users_id"=>\Auth::user()->id,
            "desde"=>$desde,
            "hasta"=>$hasta,
            "claves"=>json_encode($poliza),
            "status_id"=>1,
        ]);
    }




        $campana = campanaModel::active()->pluck('nb_campana', 'id');
        $sponsor = sponsorModel::pluck('nb_sponsor', 'id');
        return view('back_end.reportes.txt', compact('campana', 'sponsor', 'strings_xml', 'nom'));

    }

    public function show($nom)
    {
        return response()->download($nom);
    }
}