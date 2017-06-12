<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::bind('idUsuario',function ($slug){
    return \App\User::find($slug);
});
Route::bind('idCliente',function ($slug){
    return \App\Model\clientesModel::find($slug);
});
Route::bind('idPolizaAsegurado',function ($slug){
    return \App\Model\PolizaAseguradosModel::find($slug);
});
Route::bind('idAgencia',function ($slug){
    return \App\Model\agenciasModel::find($slug);
});
Route::bind('idBanco',function ($slug){
    return \App\Model\bacosModel::find($slug);
});
Route::bind('idCampana',function ($slug){
    return \App\Model\campanaModel::find($slug);
});
Route::bind('idRamos',function ($slug){
    return \App\Model\ramosModel::find($slug);
});
Route::bind('idProductos',function ($slug){
    return \App\Model\productosModel::find($slug);
});
Route::bind('idPlanes',function ($slug){
    return \App\Model\planesModel::find($slug);
});
Route::bind('idFpagos',function ($slug){
    return \App\Model\frecuenciaPagoModel::find($slug);
});
Route::bind('idCobertura',function ($slug){
    return \App\Model\coberturasModel::find($slug);
});
Route::bind('idOcupacion',function ($slug){
    return \App\Model\OcupacionModel::find($slug);
});
Route::bind('idParentesco',function ($slug){
    return \App\Model\parentescoModel::find($slug);
});
Route::bind('idSponsor',function ($slug){
    return \App\Model\sponsorModel::find($slug);
});
Route::bind('idTiBeneficiario',function ($slug){
    return \App\Model\tipoBeneficiario::where('id',$slug)->get();
});
Route::bind('idTarifario',function ($slug){
    return \App\Model\tarifarioModel::find($slug);
});
Route::bind('idAseguradoPoliza',function ($slug){
    return \App\Model\PolizaAseguradosModel::find($slug);
});
Route::bind('idPagadorPoliza',function ($slug){
    return \App\Model\polizaPagadorModel::find($slug);
});



//rutas accessibles slo si el usuario no se ha logueado
Route::group(['middleware' => 'guest'], function () {

    Route::get('/',['as'=>'/','uses'=>'Auth\LoginController@getLogin']);
    Route::post('login', ['as' =>'login-usuario', 'uses' => 'Auth\LoginController@login']);

});

//rutas accessibles solo si el usuario esta autenticado y ha ingresado al sistema
Route::group(['middleware' => 'auth'], function () {

    Route::get('home', 'backEnd\HomeController@index');

    //RUTAS DE USUARIOS 
    Route::get('listado-usuarios','backEnd\UsuariosController@index');
    Route::get('usuario-create','backEnd\UsuariosController@create');
    Route::post('usuario-create', ['as' => 'createusuario', 'uses' => 'backEnd\UsuariosController@store']);
    Route::get('editar-usuario/{idUsuario}', 'backEnd\UsuariosController@edit');
    Route::put('usuario-update/{idUsuario}', ['as' => 'updateusuario', 'uses' => 'backEnd\UsuariosController@update']);
    Route::get('perfil-usuario/{idUsuario}', 'backEnd\UsuariosController@editPerfil');
    Route::put('perfil-update/{idSubmenu}/{idUsuario}/{accion}', ['as' => 'perfil-update', 'uses' => 'backEnd\UsuariosController@updatePerfil']);


    //RUTAS ASIGNAR CLIENTES
    Route::get('clientes-asignar','backEnd\callCenterController@index');
    Route::get('asignar-individual/{idcli}/{idagente}','backEnd\asignarController@store');
    


   //RUTAS BOTONES HOME CALL CENTER
    Route::get('clientes-asignados','backEnd\callCenterController@index');
    Route::get('clientes-prospectado','backEnd\callCenterController@index');
    Route::get('clientes-agendado','backEnd\callCenterController@index');
    Route::get('clientes-tocados','backEnd\callCenterController@index');
    Route::get('clientes-ventas','backEnd\callCenterController@index');
    Route::get('clientes-noventa','backEnd\callCenterController@index');
    Route::get('clientes-efectiva','backEnd\callCenterController@index');
    Route::get('cliente-ya-es-cliente','backEnd\callCenterController@index');
    Route::get('clientes-enviadas','backEnd\callCenterController@index');

    //GESTIONAR DATA TIPIFICADOR
    Route::get('editar-gesion-cliente/{idCliente}', 'backEnd\callCenterController@edit');
    Route::get('actualizar-datos/{campo}/{dato}/{idCliente}', 'backEnd\callCenterController@update');
    Route::put('gestionar-tipificacion/{idCliente}', ['as' => 'gestionar-tipificacion', 'uses' => 'backEnd\callCenterController@store']);
    Route::get('historia-cliente/{idCliente}', 'backEnd\callCenterController@show');

    //GESTIONAR AGENDA
    Route::get('agendar-telefono/{Nro}/{idCliente}', 'backEnd\angendaController@index');
    Route::post('agendar-telefono', ['as' => 'agendar-telefono', 'uses' => 'backEnd\angendaController@store']);
    
    

   //ACCIONES TRAS TIPIFICACION - PROCESO VENTAS
    Route::get('venta-aprobada/{idCliente}', 'backEnd\vetasController@index');
    Route::post('datos-pagador-poliza', ['as' => 'datos-pagador-polizap', 'uses' => 'backEnd\vetasController@store']);
    Route::put('datos-pagador-poliza/{idPagadorPoliza}', ['as' => 'datos-pagador-poliza', 'uses' => 'backEnd\vetasController@update']);
    Route::get('datos-beneficiarios-asegurados/{idPolizaAsegurado}', 'backEnd\vetasController@addBeneficiarios');
    Route::post('datos-beneficiarios', ['as' => 'datos-beneficiariosp', 'uses' => 'backEnd\vetasController@store']);
    Route::get('listado-beneficiarios/{idCliente}/{idPolizaAsegurado}', 'backEnd\vetasController@listadoBeneficiario');
    Route::post('datos-riesgo-asegurables', ['as' => 'datos-riesgo-asegurablesp', 'uses' => 'backEnd\vetasController@store']);
    Route::get('listado-datos-riesgo-asegurables/{idCliente}', 'backEnd\vetasController@listadoDatosRiesgoAsegurable');
    Route::post('datos-asegurado-poliza', ['as' => 'datos-asegurado-polizap', 'uses' => 'backEnd\vetasController@store']);
    Route::put('datos-asegurado-poliza/{idAseguradoPoliza}', ['as' => 'datos-asegurado-poliza', 'uses' => 'backEnd\vetasController@update']);
    Route::get('listado-datos-poliza-asegurados/{idCliente}', 'backEnd\vetasController@listadoPolizaAsegurados');

    //TABLAS MAESTRAS
     // AGECIAS
    Route::get('listado-agencia', 'backEnd\tablasMaestras\agenciasController@index');
    Route::get('create-agencia', 'backEnd\tablasMaestras\agenciasController@create');
    Route::post('create-agencia', ['as' => 'create-agencia', 'uses' => 'backEnd\tablasMaestras\agenciasController@store']);
    Route::get('editar-agencia/{idAgencia}', 'backEnd\tablasMaestras\agenciasController@edit');
    Route::put('editar-agencia/{idAgencia}', ['as' => 'editar-agencia', 'uses' => 'backEnd\tablasMaestras\agenciasController@update']);

    // BANCOS
    Route::get('listado-banco', 'backEnd\tablasMaestras\bancosController@index');
    Route::get('create-banco', 'backEnd\tablasMaestras\bancosController@create');
    Route::post('create-banco', ['as' => 'create-banco', 'uses' => 'backEnd\tablasMaestras\bancosController@store']);
    Route::get('editar-banco/{idBanco}', 'backEnd\tablasMaestras\bancosController@edit');
    Route::put('editar-banco/{idBanco}', ['as' => 'editar-banco', 'uses' => 'backEnd\tablasMaestras\bancosController@update']);

    // CAMPAÑAS
    Route::get('listado-campana', 'backEnd\tablasMaestras\campanaController@index');
    Route::get('create-campana', 'backEnd\tablasMaestras\campanaController@create');
    Route::post('create-campana', ['as' => 'create-campana', 'uses' => 'backEnd\tablasMaestras\campanaController@store']);
    Route::get('editar-campana/{idCampana}', 'backEnd\tablasMaestras\campanaController@edit');
    Route::put('editar-campana/{idCampana}', ['as' => 'editar-campana', 'uses' => 'backEnd\tablasMaestras\campanaController@update']);

    // RAMOS
    Route::get('listado-ramos', 'backEnd\tablasMaestras\ramosController@index');
    Route::get('create-ramos', 'backEnd\tablasMaestras\ramosController@create');
    Route::post('create-ramos', ['as' => 'create-ramos', 'uses' => 'backEnd\tablasMaestras\ramosController@store']);
    Route::get('editar-ramos/{idRamos}', 'backEnd\tablasMaestras\ramosController@edit');
    Route::put('editar-ramos/{idRamos}', ['as' => 'editar-ramos', 'uses' => 'backEnd\tablasMaestras\ramosController@update']);

    // PRODUCTOS
    Route::get('listado-productos', 'backEnd\tablasMaestras\productoController@index');
    Route::get('create-productos', 'backEnd\tablasMaestras\productoController@create');
    Route::post('create-productos', ['as' => 'create-productos', 'uses' => 'backEnd\tablasMaestras\productoController@store']);
    Route::get('editar-productos/{idProductos}', 'backEnd\tablasMaestras\productoController@edit');
    Route::put('editar-productos/{idProductos}', ['as' => 'editar-productos', 'uses' => 'backEnd\tablasMaestras\productoController@update']);

    // PLANES
    Route::get('listado-planes', 'backEnd\tablasMaestras\planesController@index');
    Route::get('create-planes', 'backEnd\tablasMaestras\planesController@create');
    Route::post('create-planes', ['as' => 'create-planes', 'uses' => 'backEnd\tablasMaestras\planesController@store']);
    Route::get('editar-planes/{idPlanes}', 'backEnd\tablasMaestras\planesController@edit');
    Route::put('editar-planes/{idPlanes}', ['as' => 'editar-planes', 'uses' => 'backEnd\tablasMaestras\planesController@update']);

    // FRECUENCIA PAGO
    Route::get('listado-frecuencia-pago', 'backEnd\tablasMaestras\frecuenciaPagoController@index');
    Route::get('create-frecuencia-pago', 'backEnd\tablasMaestras\frecuenciaPagoController@create');
    Route::post('create-frecuencia-pago', ['as' => 'create-frecuencia-pago', 'uses' => 'backEnd\tablasMaestras\frecuenciaPagoController@store']);
    Route::get('editar-frecuencia-pago/{idFpagos}', 'backEnd\tablasMaestras\frecuenciaPagoController@edit');
    Route::put('editar-frecuencia-pago/{idFpagos}', ['as' => 'editar-frecuencia-pago', 'uses' => 'backEnd\tablasMaestras\frecuenciaPagoController@update']);

    // COBERTURAS
    Route::get('listado-cobertura', 'backEnd\tablasMaestras\coberturasController@index');
    Route::get('create-cobertura', 'backEnd\tablasMaestras\coberturasController@create');
    Route::post('create-cobertura', ['as' => 'create-cobertura', 'uses' => 'backEnd\tablasMaestras\coberturasController@store']);
    Route::get('editar-cobertura/{idCobertura}', 'backEnd\tablasMaestras\coberturasController@edit');
    Route::put('editar-cobertura/{idCobertura}', ['as' => 'editar-cobertura', 'uses' => 'backEnd\tablasMaestras\coberturasController@update']);

    // OCUPACION
    Route::get('listado-ocupacion', 'backEnd\tablasMaestras\ocupacionController@index');
    Route::get('create-ocupacion', 'backEnd\tablasMaestras\ocupacionController@create');
    Route::post('create-ocupacion', ['as' => 'create-ocupacion', 'uses' => 'backEnd\tablasMaestras\ocupacionController@store']);
    Route::get('editar-ocupacion/{idOcupacion}', 'backEnd\tablasMaestras\ocupacionController@edit');
    Route::put('editar-ocupacion/{idOcupacion}', ['as' => 'editar-ocupacion', 'uses' => 'backEnd\tablasMaestras\ocupacionController@update']);

    // PARENTESCO
    Route::get('listado-parentesto', 'backEnd\tablasMaestras\parentescoController@index');
    Route::get('create-parentesto', 'backEnd\tablasMaestras\parentescoController@create');
    Route::post('create-parentesto', ['as' => 'create-parentesto', 'uses' => 'backEnd\tablasMaestras\parentescoController@store']);
    Route::get('editar-parentesto/{idParentesco}', 'backEnd\tablasMaestras\parentescoController@edit');
    Route::put('editar-parentesto/{idParentesco}', ['as' => 'editar-parentesto', 'uses' => 'backEnd\tablasMaestras\parentescoController@update']);

    // SPONSOR
    Route::get('listado-sponsor', 'backEnd\tablasMaestras\sponsorController@index');
    Route::get('create-sponsor', 'backEnd\tablasMaestras\sponsorController@create');
    Route::post('create-sponsor', ['as' => 'create-sponsor', 'uses' => 'backEnd\tablasMaestras\sponsorController@store']);
    Route::get('editar-sponsor/{idSponsor}', 'backEnd\tablasMaestras\sponsorController@edit');
    Route::put('editar-sponsor/{idSponsor}', ['as' => 'editar-sponsor', 'uses' => 'backEnd\tablasMaestras\sponsorController@update']);

    // TIPO BENEFICIARIO
    Route::get('listado-tipo-beneficiario', 'backEnd\tablasMaestras\tipobeneficiarioController@index');
    Route::get('create-tipo-beneficiario', 'backEnd\tablasMaestras\tipobeneficiarioController@create');
    Route::post('create-tipo-beneficiario', ['as' => 'create-tipo-beneficiario', 'uses' => 'backEnd\tablasMaestras\tipobeneficiarioController@store']);
    Route::get('editar-tipo-beneficiario/{idTiBeneficiario}', 'backEnd\tablasMaestras\tipobeneficiarioController@edit');
    Route::put('editar-tipo-beneficiario/{idTiBeneficiario}', ['as' => 'editar-tipo-beneficiario', 'uses' => 'backEnd\tablasMaestras\tipobeneficiarioController@update']);

    // TARIFARIO
    Route::get('listado-tarifario', 'backEnd\tablasMaestras\tarifarioController@index');
    Route::get('create-tarifario', 'backEnd\tablasMaestras\tarifarioController@create');
    Route::post('create-tarifario', ['as' => 'create-tarifario', 'uses' => 'backEnd\tablasMaestras\tarifarioController@store']);
    Route::get('editar-tarifario/{idTarifario}', 'backEnd\tablasMaestras\tarifarioController@edit');
    Route::put('editar-tarifario/{idTarifario}', ['as' => 'editar-tarifario', 'uses' => 'backEnd\tablasMaestras\tarifarioController@update']);

    //VERIFICAR CON EL CAMBIO DEL PROCESO
    //GESTIONAR APERTURAS
    Route::get('aperturas/{tpfnivel1}/{tpfnivel2}/{tpfnivel3}/{tpfnivel4}', ['as' => 'aperturas', 'uses' => 'backEnd\callCenterController@aperturas']);

    //ACTUALIZAR NUMEROS DE REGISTRO DISPONIBLES PARA CADA OPCIÓN DEL CALL CENTER
    Route::get('nro-registros', 'backEnd\HomeController@nroRegitrosStatus');


    //GENERACIÓN DE ARCHIVOS xml
    Route::get('genera-txt','backEnd\txtController@index');
    Route::post('crear-txt',['as'=>'crear-txt','uses'=>'backEnd\txtController@store']);
    Route::get('descarga-xml/{nom}',['as'=>'descarga-xml','uses'=>'backEnd\txtController@show']);

    //GENERACIÓN DE ARCHIVOS excel
    Route::get('data-cruda','backEnd\excelController@index');
    Route::post('crear-cruda',['as'=>'crear-cruda','uses'=>'backEnd\excelController@getCruda']);

    //reporte ventas no ventas
    Route::get('reporte-ventas','backEnd\excelController@getVentasNoVentas');
    Route::post('reporte-ventas',['as'=>'reporte-ventas','uses'=>'backEnd\excelController@rptVentas']);


    //CARGA MASIVA
    Route::get('carga-masiva',['as'=>'carga-masiva','uses'=>'backEnd\cargaMasivaController@index']);
    Route::post('cargar-archivo',['as'=>'cargar-archivo','uses'=>'backEnd\cargaMasivaController@getArchivo']);

    //CARGA MASIVA
    Route::get('list-lotes',['as'=>'list-lotes','uses'=>'backEnd\lotesController@index']);
    Route::get('lote-on-of/{idLote}/{estado}',['as'=>'lote-on-of','uses'=>'backEnd\lotesController@update']);

    
    
    // CERRAR CONEX
    Route::get('cerrar-panel','backEnd\HomeController@logout');

    //RUTAS PARA COMBOS DINAMICOS
    // TIPIFICACIONES - CALL CENTER
    Route::get('tpfnivel1/{id}', ['as' => 'tpfnivel1', 'uses' => 'backEnd\combosController@getTpfnivel1']);
    Route::get('tpfnivel2/{id}', ['as' => 'tpfnivel2', 'uses' => 'backEnd\combosController@getTpfnivel2']);
    Route::get('tpfnivel3/{id}', ['as' => 'tpfnivel3', 'uses' => 'backEnd\combosController@getTpfnivel3']);
    Route::get('ciudad/{id}', ['as' => 'ciudad', 'uses' => 'backEnd\combosController@getCiudad']);
    Route::get('municipio/{id}', ['as' => 'municipio', 'uses' => 'backEnd\combosController@getMunicipio']);
    Route::get('ramos/{id}/{ramo_cliente}', ['as' => 'ramos', 'uses' => 'backEnd\combosController@getRamo']);
    Route::get('producto/{id}/{producto_cliente}', ['as' => 'producto', 'uses' => 'backEnd\combosController@getProducto']);
    Route::get('plan/{id}/{plan_cliente}', ['as' => 'plan', 'uses' => 'backEnd\combosController@getPlan']);
    Route::get('coberturas/{id}', ['as' => 'coberturas', 'uses' => 'backEnd\combosController@getCoberturas']);
    Route::get('tarifario/{id}/{idRamo}/{idProducto}/{idPlan}/{idFrecuencia}', ['as' => 'tarifario', 'uses' => 'backEnd\combosController@getTarifario']);
    Route::get('autocombo/{id}/{funcion}', ['as' => 'autocombo', 'uses' => 'backEnd\combosController@getAutocombo']);
    Route::get('cuenta-corriente/{idBanco}/', ['as' => 'cuenta-corriente', 'uses' => 'backEnd\combosController@getcuentaCorriente']);
    Route::get('multiples-planes', ['as' => 'multiples-planes', 'uses' => 'backEnd\combosController@getPlanSelect2']);
});


