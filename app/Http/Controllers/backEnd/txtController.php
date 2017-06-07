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
use DB;
use DOMDocument;
use Illuminate\Http\Request;
use App\Model\emisionXmlModel;

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

        $emision_asegurados=array();
        $emision_beneficiario=array();
        $emision_pagador=array();
        $xml = new DomDocument('1.0', 'UTF-8');
        $desde = date('Y-m-d', strtotime($request->desde));
        $hasta = date('Y-m-d', strtotime($request->hasta));
        $bancos = polizaPagadorModel::where([
            ['medio_pago_id',"<>",5],
            ['campana_id',$request->campana]
        ])
            ->whereNotNull('prima')
            ->whereBetween(DB::raw('DATE(ff_registro)'), [$desde, $hasta])
            ->distinct()
            ->active()
            ->select('banco_id')->get();

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
        foreach($bancos as $value) {
            $bank = $xml->createElement('bank');
            $bankAttribute = $xml->createAttribute('code');
            $bankAttribute->value = $value->banco_id;
            $bank->appendChild($bankAttribute);
            $banks->appendChild($bank);
            $bank_name = $xml->createElement('bank_name', $value->bancos->nb_banco);
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

            $transactions = $xml->createElement('transactions');
            $agency->appendChild($transactions);
            // TRANSACTION DEL MISMO BANCO
            $polizaPagador = polizaPagadorModel::with('plan', 'mediopago', 'frecuencia', 'campana', 'clientes', 'direcciones')
                ->where([
                    ['campana_id', $request->campana],
                    ['banco_id', $value->banco_id],
                    ['medio_pago_id',"<>",5],
                ])
                ->whereNotNull('prima')
                ->whereBetween(DB::raw('DATE(ff_registro)'), [$desde, $hasta])
                ->active()
                ->get();

            foreach($polizaPagador as $valuepolizaPagador) {
                $transaction = $xml->createElement('transaction');
                $transactions->appendChild($transaction);
                $transactionAttribute = $xml->createAttribute('id');
                $transactionAttribute->value = $valuepolizaPagador->id;
                $transaction->appendChild($transactionAttribute);
                $type_code = $xml->createElement('type_code', "E");
                $transaction->appendChild($type_code);

                $policy = $xml->createElement('policy');
                $transaction->appendChild($policy);
                $policyAttribute = $xml->createAttribute('id');
                $policyAttribute->value = $valuepolizaPagador->id;
                $policy->appendChild($policyAttribute);
                $call_id = $xml->createElement('call_id', $valuepolizaPagador->operador_id);
                $policy->appendChild($call_id);
                $number = $xml->createElement('number', " "); // $number=$xml->createElement('number',$valuepolizaPagador->id);
                $policy->appendChild($number);
                $certificate_number = $xml->createElement('certificate_number', $valuepolizaPagador->sucursal_id . str_pad($valuepolizaPagador->ramo_id, 2, 0, STR_PAD_LEFT) . $valuepolizaPagador->id);
                $policy->appendChild($certificate_number);
                $product_code = $xml->createElement('product_code', $valuepolizaPagador->producto_id);
                $policy->appendChild($product_code);
                $plan_code = $xml->createElement('plan_code', $valuepolizaPagador->plan->cod_xml);
                $policy->appendChild($plan_code);
                $issue_date = $xml->createElement('issue_date', str_replace('-', '', $valuepolizaPagador->ff_registro));
                $policy->appendChild($issue_date);
                $channel_code = $xml->createElement('channel_code', $valuepolizaPagador->canal_id);
                $policy->appendChild($channel_code);
                $insurance_agency_code = $xml->createElement('insurance_agency_code', $valuepolizaPagador->sucursal_id);
                $policy->appendChild($insurance_agency_code);
                $insurance_agency_name = $xml->createElement('insurance_agency_name', "PRINCIPAL");
                $policy->appendChild($insurance_agency_name);
                $bank_user = $xml->createElement('bank_user', $valuepolizaPagador->userbanco);
                $policy->appendChild($bank_user);
                $AON_user = $xml->createElement('AON_user', $valuepolizaPagador->userproveedor);
                $policy->appendChild($AON_user);
                $currency_type = $xml->createElement('currency_type', $valuepolizaPagador->tipo_moneda_id);
                $policy->appendChild($currency_type);
                $frequency_code = $xml->createElement('frequency_code', $valuepolizaPagador->frecuencia->cod_xml);
                $policy->appendChild($frequency_code);

                $policy_holder = $xml->createElement('policy_holder');
                $policy->appendChild($policy_holder);

                $polizaAsegurados = PolizaAseguradosModel::with('direccion', 'tarifario')->where('cliente_id', $valuepolizaPagador->clientes_id)->get();
                foreach($polizaAsegurados as $asegurado) {
                    $person = $xml->createElement('person');
                    $policy_holder->appendChild($person);
                    $name = $xml->createElement('name', $asegurado->nb_nombre);
                    $person->appendChild($name);
                    $document_type_code = $xml->createElement('document_type_code', $asegurado->nacionalidad_id);
                    $person->appendChild($document_type_code);
                    $document_number = $xml->createElement('document_number', $asegurado->nu_documento);
                    $person->appendChild($document_number);

                    $address = $xml->createElement('address');
                    $person->appendChild($address);
                    $country_code = $xml->createElement('country_code', $asegurado->direccion->pais_id);
                    $address->appendChild($country_code);
                    $country_name = $xml->createElement('country_name', "VENEZUELA");
                    $address->appendChild($country_name);
                    $state_code = $xml->createElement('state_code', $asegurado->direccion->estado_id);
                    $address->appendChild($state_code);
                    $estado = estadoModel::find($asegurado->direccion->estado_id);
                    $state_name = $xml->createElement('state_name', $estado->nb_estado);
                    $address->appendChild($state_name);
                    $ciudad = ciudadesModel::find($asegurado->direccion->ciudad_id);
                    $city_code = $xml->createElement('city_code', $ciudad->co_xml_ciudad);
                    $address->appendChild($city_code);
                    $city_name = $xml->createElement('city_name', $ciudad->nb_ciudad);
                    $address->appendChild($city_name);
                    $municipio = municipiosModel::find($asegurado->direccion->municipio_id);
                    $municipality_code = $xml->createElement('municipality_code', $municipio->co_xml_ciudad);
                    $address->appendChild($municipality_code);
                    $municipality_name = $xml->createElement('municipality_name',$municipio->nb_municipio);
                    $address->appendChild($municipality_name);
                    $parish = $xml->createElement('parish',$asegurado->direccion->nb_parroquia);
                    $address->appendChild($parish);
                    $zip_code = $xml->createElement('zip_code', $asegurado->direccion->co_postal);
                    $address->appendChild($zip_code);
                    $street = $xml->createElement('street', $asegurado->direccion->tx_avenida_calle);
                    $address->appendChild($street);
                    $estate = $xml->createElement('estate', $asegurado->direccion->tx_urbanizacion_direccion);
                    $address->appendChild($estate);
                    $building = $xml->createElement('building', $asegurado->direccion->nb_edificio_casa);
                    $address->appendChild($building);
                    $floor = $xml->createElement('floor', $asegurado->direccion->nu_piso);
                    $address->appendChild($floor);
                    $number = $xml->createElement('number', $asegurado->direccion->nu_casa);
                    $address->appendChild($number);
                    $issue_date = $xml->createElement('issue_date', str_replace('-', '', $asegurado->ff_registro));
                    $person->appendChild($issue_date);

                    $type_person = $xml->createElement('type_person');
                    $person->appendChild($type_person);
                    $type_personAttribute = $xml->createAttribute('type');
                    $type_personAttribute->value = $asegurado->tipo_persona_id;
                    $type_person->appendChild($type_personAttribute);
                    if($asegurado->tipo_persona_id == "N"){
                        $natural_person = $xml->createElement('natural_person');
                        $type_person->appendChild($natural_person);
                        $last_name = $xml->createElement('last_name', $asegurado->nb_apellido);
                        $natural_person->appendChild($last_name);
                        $last_update_date = $xml->createElement('last_update_date', str_replace('-', '', $asegurado->ff_ultima_actualizacion));
                        $natural_person->appendChild($last_update_date);
                        $education_degree_code = $xml->createElement('education_degree_code', $asegurado->nivel_educativo_id);
                        $natural_person->appendChild($education_degree_code);
                        $nivel_educativo = nivelEducativoModel::find($asegurado->nivel_educativo_id);
                        $education_degree_name = $xml->createElement('education_degree_name', $nivel_educativo->nb_nivel_educativo);
                        $natural_person->appendChild($education_degree_name);
                        $occuppation_code = $xml->createElement('occuppation_code', str_pad($asegurado->ocupacion_id, 3, 0, STR_PAD_LEFT));
                        $natural_person->appendChild($occuppation_code);
                        $ocupacion = OcupacionModel::find($asegurado->ocupacion_id);
                        $occuppation_name = $xml->createElement('occuppation_name', $ocupacion->nb_ocupacion);
                        $natural_person->appendChild($occuppation_name);
                        $birthdate = $xml->createElement('birthdate', str_replace('-', '', $asegurado->ff_nacimiento));
                        $natural_person->appendChild($birthdate);
                        $gender = $xml->createElement('gender', $asegurado->sexo_id);
                        $natural_person->appendChild($gender);
                        $marital_status = $xml->createElement('marital_status', $asegurado->estadocivil_id);
                        $natural_person->appendChild($marital_status);
                        $children_number = $xml->createElement('children_number', $asegurado->nu_hijos);
                        $natural_person->appendChild($children_number);
                        $email = $xml->createElement('email', $asegurado->email);
                        $natural_person->appendChild($email);
                        $home_telephone1 = $xml->createElement('home_telephone1', $asegurado->nu_tlf_hogar);
                        $natural_person->appendChild($home_telephone1);
                        $cellular_phone = $xml->createElement('cellular_phone', $asegurado->nu_tlf_celular);
                        $natural_person->appendChild($cellular_phone);
                        $company_name = $xml->createElement('company_name', $asegurado->nb_empresa);
                        $natural_person->appendChild($company_name);
                        $position = $xml->createElement('position', $asegurado->nb_cargo);
                        $natural_person->appendChild($position);
                        $income_amount = $xml->createElement('income_amount', str_replace(",", ".", $asegurado->nu_ingresos));
                        $natural_person->appendChild($income_amount);
                        $office_telephone1 = $xml->createElement('office_telephone1',str_pad($asegurado->nu_tlf_oficina1,1,"", STR_PAD_LEFT));
                        $natural_person->appendChild($office_telephone1);
                        $office_telephone2 = $xml->createElement('office_telephone2',str_pad($asegurado->nu_tlf_oficina2,1," ", STR_PAD_LEFT));
                        $natural_person->appendChild($office_telephone2);
                    } else {
                        $legal_person = $xml->createElement('legal_person');
                        $type_person->appendChild($legal_person);
                        $last_update_date = $xml->createElement('last_update_date', str_replace('-', '', $asegurado->ff_ultima_actualizacion));
                        $legal_person->appendChild($last_update_date);
                        $economy_activity_code = $xml->createElement('economy_activity_code', $asegurado->activida_economica_id);
                        $legal_person->appendChild($economy_activity_code);
                        $actividadEconomica = actividadEconomicaCivilModel::find($asegurado->activida_economica_id);
                        $economy_activity = $xml->createElement('economy_activity', $actividadEconomica->nb_actividad_economica);
                        $legal_person->appendChild($economy_activity);
                        $income_amount = $xml->createElement('income_amount', str_replace(",", ".", $asegurado->nu_capital_promedio));
                        $legal_person->appendChild($income_amount);
                        $office_telephone1 = $xml->createElement('office_telephone1',str_pad($asegurado->nu_tlf_oficina1,1," ", STR_PAD_LEFT));
                        $legal_person->appendChild($office_telephone1);
                        $office_telephone2 = $xml->createElement('office_telephone2',str_pad($asegurado->nu_tlf_oficina2,1," ", STR_PAD_LEFT));
                        $legal_person->appendChild($office_telephone2);

                    }
                    array_push($emision_asegurados,$asegurado->id);
                    PolizaAseguradosModel::where('id',$asegurado->id)->update(['status_id' => 12]);
                }

                $polizaTomador = tomadorPolizaModel::with('direcciones')->where('clientes_id', $valuepolizaPagador->clientes_id)->first();
                $policy_taker = $xml->createElement('policy_taker');
                $policy->appendChild($policy_taker);
                $person = $xml->createElement('person');
                $policy_taker->appendChild($person);
                $name = $xml->createElement('name', $valuepolizaPagador->nb_nombre);
                $person->appendChild($name);
                $document_type_code = $xml->createElement('document_type_code', $valuepolizaPagador->nacionalidad_id);
                $person->appendChild($document_type_code);
                $document_number = $xml->createElement('document_number', $valuepolizaPagador->nu_documento);
                $person->appendChild($document_number);

                $address = $xml->createElement('address');
                $person->appendChild($address);
                $country_code = $xml->createElement('country_code', $valuepolizaPagador->direcciones->pais_id);
                $address->appendChild($country_code);
                $country_name = $xml->createElement('country_name', "VENEZUELA");
                $address->appendChild($country_name);
                $state_code = $xml->createElement('state_code', $valuepolizaPagador->direcciones->estado_id);
                $address->appendChild($state_code);
                $estado = estadoModel::find($valuepolizaPagador->direcciones->estado_id);
                $state_name = $xml->createElement('state_name', $estado->nb_estado);
                $address->appendChild($state_name);
                $ciudad = ciudadesModel::find($valuepolizaPagador->direcciones->ciudad_id);
                $city_code = $xml->createElement('city_code', $ciudad->co_xml_ciudad);
                $address->appendChild($city_code);
                $city_name = $xml->createElement('city_name', $ciudad->nb_ciudad);
                $address->appendChild($city_name);
                $municipio = municipiosModel::find($valuepolizaPagador->direcciones->municipio_id);
                $municipality_code = $xml->createElement('municipality_code',$municipio->co_xml_ciudad);
                $address->appendChild($municipality_code);
                $municipality_name = $xml->createElement('municipality_name',$municipio->nb_municipio);
                $address->appendChild($municipality_name);
                $parish = $xml->createElement('parish', $valuepolizaPagador->direcciones->nb_parroquia);
                $address->appendChild($parish);
                $zip_code = $xml->createElement('zip_code', $valuepolizaPagador->direcciones->co_postal);
                $address->appendChild($zip_code);
                $street = $xml->createElement('street', $valuepolizaPagador->direcciones->tx_avenida_calle);
                $address->appendChild($street);
                $estate = $xml->createElement('estate', $valuepolizaPagador->direcciones->tx_urbanizacion_direccion);
                $address->appendChild($estate);
                $building = $xml->createElement('building', $valuepolizaPagador->direcciones->nb_edificio_casa);
                $address->appendChild($building);
                $floor = $xml->createElement('floor', $valuepolizaPagador->direcciones->nu_piso);
                $address->appendChild($floor);
                $number = $xml->createElement('number', $valuepolizaPagador->direcciones->nu_casa);
                $address->appendChild($number);
                $issue_date = $xml->createElement('issue_date', str_replace('-', '', $valuepolizaPagador->ff_registro));
                $person->appendChild($issue_date);

                $type_person = $xml->createElement('type_person');
                $person->appendChild($type_person);
                $type_personAttribute = $xml->createAttribute('type');
                $type_personAttribute->value = $valuepolizaPagador->tipo_persona_id;
                $type_person->appendChild($type_personAttribute);
                if($valuepolizaPagador->tipo_persona_id == "N"){
                    $natural_person = $xml->createElement('natural_person');
                    $type_person->appendChild($natural_person);
                    $last_name = $xml->createElement('last_name', $valuepolizaPagador->nb_apellido);
                    $natural_person->appendChild($last_name);
                    $last_update_date = $xml->createElement('last_update_date', str_replace('-', '', $valuepolizaPagador->ff_ultima_actualizacion));
                    $natural_person->appendChild($last_update_date);
                    $education_degree_code = $xml->createElement('education_degree_code', $valuepolizaPagador->nivel_educativo_id);
                    $natural_person->appendChild($education_degree_code);
                    $nivel_educativo = nivelEducativoModel::find($valuepolizaPagador->nivel_educativo_id);
                    $education_degree_name = $xml->createElement('education_degree_name', $nivel_educativo->nb_nivel_educativo);
                    $natural_person->appendChild($education_degree_name);
                    $occuppation_code = $xml->createElement('occuppation_code', str_pad($valuepolizaPagador->ocupacion_id, 3, 0, STR_PAD_LEFT));
                    $natural_person->appendChild($occuppation_code);
                    $ocupacion = OcupacionModel::find($valuepolizaPagador->ocupacion_id);
                    $occuppation_name = $xml->createElement('occuppation_name', $ocupacion->nb_ocupacion);
                    $natural_person->appendChild($occuppation_name);
                    $birthdate = $xml->createElement('birthdate', str_replace('-', '', $valuepolizaPagador->ff_nacimiento));
                    $natural_person->appendChild($birthdate);
                    $gender = $xml->createElement('gender', $valuepolizaPagador->sexo_id);
                    $natural_person->appendChild($gender);
                    $marital_status = $xml->createElement('marital_status', $valuepolizaPagador->estadocivil_id);
                    $natural_person->appendChild($marital_status);
                    $children_number = $xml->createElement('children_number', $valuepolizaPagador->nu_hijos);
                    $natural_person->appendChild($children_number);
                    $email = $xml->createElement('email', $valuepolizaPagador->email);
                    $natural_person->appendChild($email);
                    $home_telephone1 = $xml->createElement('home_telephone1', $valuepolizaPagador->nu_tlf_hogar);
                    $natural_person->appendChild($home_telephone1);
                    $cellular_phone = $xml->createElement('cellular_phone', $valuepolizaPagador->nu_tlf_celular);
                    $natural_person->appendChild($cellular_phone);
                    $company_name = $xml->createElement('company_name', $valuepolizaPagador->nb_empresa);
                    $natural_person->appendChild($company_name);
                    $position = $xml->createElement('position', $valuepolizaPagador->nb_cargo);
                    $natural_person->appendChild($position);
                    $income_amount = $xml->createElement('income_amount', $valuepolizaPagador->nu_ingresos);
                    $natural_person->appendChild($income_amount);
                    $office_telephone1 = $xml->createElement('office_telephone1',str_pad($valuepolizaPagador->nu_tlf_oficina1,1," ", STR_PAD_LEFT));
                    $natural_person->appendChild($office_telephone1);
                    $office_telephone2 = $xml->createElement('office_telephone2',str_pad($valuepolizaPagador->nu_tlf_oficina2,1," ", STR_PAD_LEFT));
                    $natural_person->appendChild($office_telephone2);
                } else {
                    $legal_person = $xml->createElement('legal_person');
                    $type_person->appendChild($legal_person);
                    $last_update_date = $xml->createElement('last_update_date', str_replace('-', '', $valuepolizaPagador->ff_ultima_actualizacion));
                    $legal_person->appendChild($last_update_date);
                    $economy_activity_code = $xml->createElement('economy_activity_code', $valuepolizaPagador->activida_economica_id);
                    $legal_person->appendChild($economy_activity_code);
                    $actividadEconomica = actividadEconomicaCivilModel::find($valuepolizaPagador->activida_economica_id);
                    $economy_activity = $xml->createElement('economy_activity', $actividadEconomica->nb_actividad_economica);
                    $legal_person->appendChild($economy_activity);
                    $income_amount = $xml->createElement('income_amount', $valuepolizaPagador->nu_capital_promedio);
                    $legal_person->appendChild($income_amount);
                    $office_telephone1 = $xml->createElement('office_telephone1',str_pad($valuepolizaPagador->nu_tlf_oficina1,1," ", STR_PAD_LEFT));
                    $legal_person->appendChild($office_telephone1);
                    $office_telephone2 = $xml->createElement('office_telephone2',str_pad($valuepolizaPagador->nu_tlf_oficina2,1," ", STR_PAD_LEFT));
                    $legal_person->appendChild($office_telephone2);

                }

                $policy_payer = $xml->createElement('policy_payer');
                $policy->appendChild($policy_payer);
                $person = $xml->createElement('person');
                $policy_payer->appendChild($person);
                $name = $xml->createElement('name', $valuepolizaPagador->nb_nombre);
                $person->appendChild($name);
                $document_type_code = $xml->createElement('document_type_code', $valuepolizaPagador->nacionalidad_id);
                $person->appendChild($document_type_code);
                $document_number = $xml->createElement('document_number', $valuepolizaPagador->nu_documento);
                $person->appendChild($document_number);

                $address = $xml->createElement('address');
                $person->appendChild($address);
                $country_code = $xml->createElement('country_code', $valuepolizaPagador->direcciones->pais_id);
                $address->appendChild($country_code);
                $country_name = $xml->createElement('country_name', "VENEZUELA");
                $address->appendChild($country_name);
                $state_code = $xml->createElement('state_code', $valuepolizaPagador->direcciones->estado_id);
                $address->appendChild($state_code);
                $estado = estadoModel::find($valuepolizaPagador->direcciones->estado_id);
                $state_name = $xml->createElement('state_name', $estado->nb_estado);
                $address->appendChild($state_name);
                $ciudad = ciudadesModel::find($valuepolizaPagador->direcciones->ciudad_id);
                $city_code = $xml->createElement('city_code', $ciudad->co_xml_ciudad);
                $address->appendChild($city_code);
                $city_name = $xml->createElement('city_name', $ciudad->nb_ciudad);
                $address->appendChild($city_name);
                $municipio = municipiosModel::find($valuepolizaPagador->direcciones->municipio_id);
                $municipality_code = $xml->createElement('municipality_code', $municipio->co_xml_ciudad);
                $address->appendChild($municipality_code);
                $municipality_name = $xml->createElement('municipality_name', $municipio->nb_municipio);
                $address->appendChild($municipality_name);
                $parish = $xml->createElement('parish', $valuepolizaPagador->direcciones->nb_parroquia);
                $address->appendChild($parish);
                $zip_code = $xml->createElement('zip_code', $valuepolizaPagador->direcciones->co_postal);
                $address->appendChild($zip_code);
                $street = $xml->createElement('street', $valuepolizaPagador->direcciones->tx_avenida_calle);
                $address->appendChild($street);
                $estate = $xml->createElement('estate', $valuepolizaPagador->direcciones->tx_urbanizacion_direccion);
                $address->appendChild($estate);
                $building = $xml->createElement('building', $valuepolizaPagador->direcciones->nb_edificio_casa);
                $address->appendChild($building);
                $floor = $xml->createElement('floor', $valuepolizaPagador->direcciones->nu_piso);
                $address->appendChild($floor);
                $number = $xml->createElement('number', $valuepolizaPagador->direcciones->nu_casa);
                $address->appendChild($number);
                $issue_date = $xml->createElement('issue_date', str_replace('-', '', $valuepolizaPagador->ff_registro));
                $person->appendChild($issue_date);

                $type_person = $xml->createElement('type_person');
                $person->appendChild($type_person);
                $type_personAttribute = $xml->createAttribute('type');
                $type_personAttribute->value = $valuepolizaPagador->tipo_persona_id;
                $type_person->appendChild($type_personAttribute);
                if($valuepolizaPagador->tipo_persona_id == "N"){
                    $natural_person = $xml->createElement('natural_person');
                    $type_person->appendChild($natural_person);
                    $last_name = $xml->createElement('last_name', $valuepolizaPagador->nb_apellido);
                    $natural_person->appendChild($last_name);
                    $last_update_date = $xml->createElement('last_update_date', str_replace('-', '', $valuepolizaPagador->ff_ultima_actualizacion));
                    $natural_person->appendChild($last_update_date);
                    $education_degree_code = $xml->createElement('education_degree_code', $valuepolizaPagador->nivel_educativo_id);
                    $natural_person->appendChild($education_degree_code);
                    $nivel_educativo = nivelEducativoModel::find($valuepolizaPagador->nivel_educativo_id);
                    $education_degree_name = $xml->createElement('education_degree_name', $nivel_educativo->nb_nivel_educativo);
                    $natural_person->appendChild($education_degree_name);
                    $occuppation_code = $xml->createElement('occuppation_code',str_pad($valuepolizaPagador->ocupacion_id,3,0,STR_PAD_LEFT));
                    $natural_person->appendChild($occuppation_code);
                    $ocupacion = OcupacionModel::find($valuepolizaPagador->ocupacion_id);
                    $occuppation_name = $xml->createElement('occuppation_name', $ocupacion->nb_ocupacion);
                    $natural_person->appendChild($occuppation_name);
                    $birthdate = $xml->createElement('birthdate', str_replace('-', '', $valuepolizaPagador->ff_nacimiento));
                    $natural_person->appendChild($birthdate);
                    $gender = $xml->createElement('gender', $valuepolizaPagador->sexo_id);
                    $natural_person->appendChild($gender);
                    $marital_status = $xml->createElement('marital_status', $valuepolizaPagador->estadocivil_id);
                    $natural_person->appendChild($marital_status);
                    $children_number = $xml->createElement('children_number', $valuepolizaPagador->nu_hijos);
                    $natural_person->appendChild($children_number);
                    $email = $xml->createElement('email', $valuepolizaPagador->email);
                    $natural_person->appendChild($email);
                    $home_telephone1 = $xml->createElement('home_telephone1', $valuepolizaPagador->nu_tlf_hogar);
                    $natural_person->appendChild($home_telephone1);
                    $cellular_phone = $xml->createElement('cellular_phone', $valuepolizaPagador->nu_tlf_celular);
                    $natural_person->appendChild($cellular_phone);
                    $company_name = $xml->createElement('company_name', $valuepolizaPagador->nb_empresa);
                    $natural_person->appendChild($company_name);
                    $position = $xml->createElement('position', $valuepolizaPagador->nb_cargo);
                    $natural_person->appendChild($position);
                    $income_amount = $xml->createElement('income_amount', $valuepolizaPagador->nu_ingresos);
                    $natural_person->appendChild($income_amount);
                    $office_telephone1 = $xml->createElement('office_telephone1',str_pad($valuepolizaPagador->nu_tlf_oficina1,1," ", STR_PAD_LEFT));
                    $natural_person->appendChild($office_telephone1);
                    $office_telephone2 = $xml->createElement('office_telephone2',str_pad($valuepolizaPagador->nu_tlf_oficina2,1," ", STR_PAD_LEFT));
                    $natural_person->appendChild($office_telephone2);
                } else {
                    $legal_person = $xml->createElement('legal_person');
                    $type_person->appendChild($legal_person);
                    $last_update_date = $xml->createElement('last_update_date', str_replace('-', '', $valuepolizaPagador->ff_ultima_actualizacion));
                    $legal_person->appendChild($last_update_date);
                    $economy_activity_code = $xml->createElement('economy_activity_code', $valuepolizaPagador->activida_economica_id);
                    $legal_person->appendChild($economy_activity_code);
                    $actividadEconomica = actividadEconomicaCivilModel::find($valuepolizaPagador->activida_economica_id);
                    $economy_activity = $xml->createElement('economy_activity', $actividadEconomica->nb_actividad_economica);
                    $legal_person->appendChild($economy_activity);
                    $income_amount = $xml->createElement('income_amount', $valuepolizaPagador->nu_capital_promedio);
                    $legal_person->appendChild($income_amount);
                    $office_telephone1 = $xml->createElement('office_telephone1',str_pad($valuepolizaPagador->nu_tlf_oficina1,1," ", STR_PAD_LEFT));
                    $legal_person->appendChild($office_telephone1);
                    $office_telephone2 = $xml->createElement('office_telephone2',str_pad($valuepolizaPagador->nu_tlf_oficina2,1," ", STR_PAD_LEFT));
                    $legal_person->appendChild($office_telephone2);

                }
                $payment_means = $xml->createElement('payment_means');
                $policy_payer->appendChild($payment_means);
                $payment_mean = $xml->createElement('payment_mean');
                $payment_means->appendChild($payment_mean);
                $payment_mean_code = $xml->createElement('payment_mean_code', $valuepolizaPagador->mediopago->cod_xml);
                $payment_mean->appendChild($payment_mean_code);
                $payment_mean_name = $xml->createElement('payment_mean_name', $valuepolizaPagador->mediopago->nb_medio_pago);
                $payment_mean->appendChild($payment_mean_name);
                $payment_mean_number = $xml->createElement('payment_mean_number', str_replace('-', '', $valuepolizaPagador->nu_medio_pago));
                $payment_mean->appendChild($payment_mean_number);

                $beneficiaries = $xml->createElement('beneficiaries');
                $policy->appendChild($beneficiaries);
                $polizaBeneficiarios = beneficiariosModel::where('clientes_id', $valuepolizaPagador->clientes_id)->get();
                foreach($polizaBeneficiarios as $benefiarios) {
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
                    $coverages = $xml->createElement('coverages');
                    $beneficiary->appendChild($coverages);
                    $cobertura = coberturasModel::where('plan_id', $valuepolizaPagador->plan_id)->where('caso_muerte', 1)->first();
                    $coverage = $xml->createElement('coverage');
                    $coverages->appendChild($coverage);
                    $code = $xml->createElement('code', $cobertura->cod_cml);
                    $coverage->appendChild($code);
                    $name = $xml->createElement('name', $cobertura->nb_cobertura);
                    $coverage->appendChild($name);
                    $numBeneficiarios = beneficiariosModel::where('clientes_id', $valuepolizaPagador->clientes_id)->count();
                    $porcentaje = (100 / $numBeneficiarios);
                    $percentage = $xml->createElement('percentage', round($porcentaje));
                    $coverage->appendChild($percentage);
                    array_push($emision_beneficiario,$benefiarios->id);
                    beneficiariosModel::where('id',$benefiarios->id)->update(['status_id' => 12]);
                }

                $receipt = $xml->createElement('receipt');
                $policy->appendChild($receipt);
                $number = $xml->createElement('number', $valuepolizaPagador->id);
                $receipt->appendChild($number);
                $begin_date = $xml->createElement('begin_date', str_replace('-', '', date('Y-m-d')));
                $receipt->appendChild($begin_date);
                $end_date = $xml->createElement('end_date', str_replace('-', '', date('Y-m-d')));
                $receipt->appendChild($end_date);
                $sent_date = $xml->createElement('sent_date', str_replace('-', '', date('Y-m-d')));
                $receipt->appendChild($sent_date);
                $last_charge_date = $xml->createElement('last_charge_date', str_replace('-', '', date('Y-m-d')));
                $receipt->appendChild($last_charge_date);
                $total_amount = $xml->createElement('total_amount', str_replace(',', '.', $valuepolizaPagador->prima));
                $receipt->appendChild($total_amount);
                $payment = $xml->createElement('payment');
                $receipt->appendChild($payment);
                $payment_mean_number = $xml->createElement('payment_mean_number', str_replace('-', '', $valuepolizaPagador->nu_medio_pago));
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
                array_push($emision_pagador,$valuepolizaPagador->id);
                polizaPagadorModel::where('id',$valuepolizaPagador->id)->update(['status_id' => 12]);

            }

        }
        $total_operations = $xml->createElement('total_operations', $totalOperaciones);
        $insurance_transactions->appendChild($total_operations);

        $xml->formatOutput = true;  //poner los string en la variable $strings_xml:
        $strings_xml = $xml->saveXML();
        $sponsor = sponsorModel::find($request->sponsor);
        $lote = loteXmlModel::all()->first();
        $campana = campanaModel::find($request->campana);
        emisionXmlModel::create([
            "users_id"=>\Auth::user()->id,
            "desde"=>$desde,
            "hasta"=>$hasta,
            "claves"=>json_encode(["ID_EMITIDOS"=>
                array('emision_pagador'=>$emision_pagador,
                    'emision_asegurados'=>$emision_asegurados,
                    'emision_beneficiario'=>$emision_beneficiario)
            ]),
            "status_id"=>1,
        ]);

        $nom = 'DIREC_' . $sponsor->nb_sponsor . '_' . date('dmY', strtotime($desde)) . '_' . $campana->nb_campana . '_' . date('dmY', strtotime($hasta)) . '_' . $lote->nu_lote . '_EMIS.xml';
        $xml->save($nom);
        loteXmlModel::where('id', 1)->increment('nu_lote');
        $campana = campanaModel::active()->pluck('nb_campana', 'id');
        $sponsor = sponsorModel::pluck('nb_sponsor', 'id');

        return view('back_end.reportes.txt', compact('campana', 'sponsor', 'strings_xml', 'nom'));
        //return view('back_end.reportes.txt');
        //return response()->json('DIREC_'.$sponsor->nb_sponsor.'_24042017_'.$campana.'_'.date('dmY').'_1_EMIS.xml');
    }

    public function show($nom)
    {
        return response()->download($nom);
    }
}