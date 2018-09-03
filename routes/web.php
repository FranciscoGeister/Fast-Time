<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('disponibilidad', 'AdministracionController');


//Configuracion
Route::resource('variables', 'Configuracion\ConfigController');

//Configuracion cargos
Route::post('/create_cargo', 'Configuracion\ConfigController@store_cargo');
Route::post('/edit_cargo/{id}', 'Configuracion\ConfigController@edit_cargo');
Route::delete('/destroy_cargo/{id}', 'Configuracion\ConfigController@destroy_cargo');

//Configuracion sedes
Route::get('/sede/create', 'Configuracion\SedeController@go_to_create');
Route::get('/go_to_edit/{id}', 'Configuracion\SedeController@go_to_edit');
Route::post('/create_sede', 'Configuracion\SedeController@store_sede');
Route::put('/edit_sede/{id}', 'Configuracion\SedeController@edit_sede');
Route::delete('/destroy_sede/{id}', 'Configuracion\SedeController@destroy_sede');

//Formulario inscripción de personal
Route::get('/agregar', 'Personal\PersonalController@index');
Route::put('/update/{id}', 'Personal\PersonalController@update');
Route::get('/edit_personal/{id}', 'Personal\PersonalController@gotoedit');
Route::get('/personal', 'Personal\PersonalController@download')->name('personal');
Route::post('/posts', 'Personal\PersonalController@store');
Route::delete('/posts/{id}', 'Personal\PersonalController@delete');

//FullCalendar Routes
Route::resource('events', 'EventsController',['only' => ['index', 'store', 'update', 'destroy']]);
Route::delete('/posts/{id}', 'Personal\PersonalController@delete');

//rutas bodega
Route::resource('productos', 'Products\ProductController');
Route::resource('underwears', 'Products\UnderwearController');
Route::resource('aseo', 'Products\CleaningProductController');

//rutas control bodega
Route::resource('controlIngreso', 'ControlBodega\ProductEntryController');
Route::resource('controlTransfer', 'ControlBodega\ProductTransferController');
Route::get('getProducts/{id}', 'ControlBodega\ProductTransferController@getProducts');

//rutas configuracion
Route::get('socios/activar/{id}/{id2}','MemberController@activate');
Route::get('socios/consultas', 'MemberController@consultas');
Route::resource('socios', 'MemberController');
Route::resource('planes', 'PlanController');
Route::resource('programas', 'ProgramController');
Route::resource('clientes', 'ClientController');
Route::resource('sesiones', 'SesionController');
Route::resource('pagos', 'PaymentController');
Route::resource('maquinas','MachineController');
Route::resource('estados','StatusController');
Route::resource('tallas','SizeController');
Route::resource('unidades','UnityController');
Route::resource('tipo_programas','ProgramTypeController');
Route::resource('ejercicios','ExerciseController');
Route::resource('implementos','ImplementController');
Route::resource('pathologies','PathologyController');
Route::resource('preguntas_medicas','PreguntaMedicaController');
Route::resource('logros','AchievementController');
Route::resource('antecedentes','AntecedenteController');
Route::resource('habitos','HabitoController');
Route::post('habitos/{tipo}','HabitoController@store');


//Rutas Agendar Horas
Route::get('agendar_hora', 'Horas\CitasController@ver_citas');
Route::post('store_cite', 'Horas\CitasController@store');
Route::get('event_sede/{id}', 'Horas\CitasController@event_sede');
Route::get('event_machine/{id}', 'Horas\CitasController@event_machine');
Route::get('hours_sede/{id}', 'Horas\CitasController@hour_sede');
Route::get('member_sesion/{id}', 'Horas\CitasController@member_info');
Route::delete('cites_delete/{id}', 'Horas\CitasController@delete');
Route::resource('cites', 'Horas\CitasController',['only' => ['update']]);

//Autocomplete
Route::get('display-search-queries','AutoCompleteController@searchData');
Route::get('display-search-products','AutoCompleteController@searchProducts');
Route::get('display-search-professionals','AutoCompleteController@searchProfessionals');
Route::get('searchFromData/{data}','AutoCompleteController@searchFromData');
//Francisco
Route::get('/traslado','ControlBodega\ProductTransferController@getSucursales');
Route::get('/getProducts','ControlBodega\ProductTransferController@findProductName');
Route::get('/getStock','ControlBodega\ProductTransferController@findStock');

//Francisco
Route::resource('planUsuario','MemberHasPlanController');
Route::get('/getValor','MemberHasPlanController@findValor');
Route::get('/getPlans','MemberHasPlanController@getPlanes');
Route::get('/getPrograms','MemberHasPlanController@getProgramas');
Route::resource('sesionesUsuario','MemberHasSesionController');
Route::get('/getValorProduct','MemberHasPlanController@getValorProduct');
Route::get('/getValorUnder','MemberHasPlanController@getValorUnder');
Route::get('/getValorSession','MemberHasPlanController@getValorSession');
Route::get('inf_pagos','SaleController@infPagos');
Route::get('informe_pagos','SaleController@informePagos');
Route::get('inf_mensual','SaleController@monthly_rep');
Route::get('informe_mensual','SaleController@monthly_report');
Route::resource('ingresos','SaleController');
Route::resource('fichaSesion','SessionTabController');
Route::resource('cycles','CycleController');
Route::resource('registroSesion','SessionRecordController');
Route::resource('fichaEvaluaciones','EvaluationSheetController');
Route::resource('registroEvaluacion','EvaluationSessionController');
Route::get('sell_products/venta_interna','SoldProductController@ventaInterna');
Route::get('sell_products/interna','SoldProductController@interna');
Route::resource('sell_products','SoldProductController');
Route::resource('fichaPersonal','PersonalFileController');
Route::resource('deudas','MemberDebtController');
Route::resource('historial_deudas','DebtHistoryController');
Route::resource('deudas_profesional','ProfessionalDebtController');
Route::resource('historial_deudas_profesional','ProfessionalDebtHistoryController');
Route::resource('turnos','WorkingDayController');
Route::get('logs','LogController@index');
Route::get('sale_detail/{id}','LogController@saleDetail');
Route::get('cancel_sale/{id}','LogController@cancelSale');
Route::get('ventaCortesiaIndex','MemberHasSesionController@ventaCortesiaIndex');
Route::get('ventaCortesia','MemberHasSesionController@ventaCortesia');


//fidelizacion
Route::resource('campañas','CampaignController');
Route::get('campañas/{id}/editar','CampaignController@editar');
Route::put('campañas/{id}','CampaignController@update');
Route::delete('campañas/{id}','CampaignController@destroy');
Route::resource('notifications','NotificationController');
Route::get('sendNotification/{id}','NotificationController@sendNotification');
Route::get('sendQuickNotification','NotificationController@sendQuickNotification');
Route::resource('encuesta/{id}', 'EncuestaController');
Route::get('getAntecedentes/{id}','EncuestaController@getAntecedentes');
Route::get('getPatologias/{id}','EncuestaController@getPatologias');
Route::get('getPreguntas/{id}','EncuestaController@getPreguntas');
Route::get('getHabitos/{id}','EncuestaController@getHabitos');
