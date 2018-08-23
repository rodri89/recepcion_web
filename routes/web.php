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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth', 'usuarioEmpresa']], function () {
	Route::get('/eventos', 'EventosController@getIndex');//muestra la vista de los eventos
	Route::get('/eventos/inhabilitados', 'EventosController@getInhabilitados');//muestra la vista de los eventos INHABILITADOS
	Route::get('/eventos/clientes', 'EventosController@clientes');//muestra los clientes de una empresa
	Route::get('/eventos/nuevo', 'EventosController@nuevo');//muestra la vista para crear un nuevo evento
	Route::get('/eventos/pagos', 'EventosController@pagos');//muestra los clientes de una empresa
	Route::get('/DatosEmpresa', 'EventosController@ActualizarDatosEmpresa');//muestra la pantalla para que la empresa actualice sus datos
	Route::get('/Contacto', 'EventosController@Contacto');//muestra la pantalla para que la empresa vea como contactarce con nosotros
	Route::get('/eventos/update/{id}', 'EventosController@actualizar_evento')->name('mostrar_pantalla_update');//muestra la pantalla para actualizar un evento
	
	Route::get('/eventos/imprimir/{id}', 'EventosController@imprimir')->name('imprimir');//muestra la pantalla para actualizar un evento
	
	
	Route::post('/eventos/ver', 'EventosController@mostrar');//muestra en el Modal los datos del evento
	
	Route::get('/clientes/update/{id}', 'ClientesController@actualizar_cliente')->name('update_cliente');//muestra la pantalla para actualizar un cliente
	Route::post('/eventos/clientes/sus_eventos' , 'EventosController@verEventosCliente');//muestra los eventos que tiene un cliente
	Route::get('/eventos/mesa_del_cliente/{eveId}' , 'EventosController@mesaDelCliente')->name('mesa_del_cliente');//muestra los eventos que tiene un cliente

	Route::get('/eventos/clientes/listar_eventos/{cli_id}' , 'EventosController@listarEventos')->name('listarEventos');
	Route::post('/eventos/cliente/busqueda', 'ClientesController@buscar_cliente');//buscar y devolver datos de un cliente
	Route::post('/eventos/busqueda', 'EventosController@buscar_evento');//buscar y devolver datos de un evento
	Route::post ( '/eventos/nuevo/nuevo_evento', 'EventosController@add' )->name('add_evento');//agregar un nuevo evento
	Route::post ( '/eventos/update/update_evento', 'EventosController@update' )->name('update_evento');//alctualiza un evento
	Route::post ( '/eventos/inhabilitar/inhabilitar_evento', 'EventosController@inhabilitar' )->name('inhabilitar');//elimina un evento
	Route::post ( '/clientes/nuevo_cliente', 'ClientesController@add' );//agregar un nuevo cliente
	Route::post ( '/clientes/update/update_cliente', 'ClientesController@update' )->name('cliente.update');//actualizar un cliente
	Route::post('/DatosEmpresa/update', 'EventosController@DatosEmpresaUpdate');//actualizar los datos de la empresa
	Route::post('/DatosEmpresa/contraseña/update', 'EventosController@DatosEmpresaContraseñaUpdate');//actualizar la contraseña de la empresa
	
	Route::post('/clientes/mesas/obtener_listaInvitados', 'EventosController@listaInvitados');
	Route::post('/clientes/mesas/resumenCantidadInvitados', 'EventosController@resumenCantidadInvitados');

	//Route::resource('cliente','ClientesController');
});

Route::group(['middleware' => ['auth', 'usuarioCliente']], function () {
	Route::get('/clientes/eventos_clientes', 'ClientesController@mesaClientes');
	Route::get('/mesas/mesas', 'mesasController@index');

	Route::post('/mesas/mesasGuardar', 'mesasController@save'); // guarda un nuevo invitado
	Route::post('/mesas/mesaCliente', 'mesasController@mesaCliente');
	Route::post('/mesas/mesas_base', 'mesasController@actualizarBase');
	Route::get('/mesas/prueba', 'mesasController@prueba');
	Route::post('/mesas/mesas_base_eliminar', 'mesasController@actualizarBaseEliminar');
	Route::post('/mesas/obtener_listaInvitados', 'mesasController@listaInvitados');
	Route::post('/mesas/guardar_datos', 'mesasController@guardarDatos');
	Route::post('/mesas/listar_resumen', 'mesasController@listarResumen');
	Route::post('/mesas/resumenCantidadInvitados', 'mesasController@resumenCantidadInvitados');
	Route::post('/mesas/test', 'mesasController@test');
	Route::get('/mesas/unaMesa', 'mesasController@cargarUnaMesa');

	
});

Route::group(['middleware' => ['auth', 'usuarioAdmin']], function () {
	Route::get('/administrador', 'AdminsController@getIndex');
	Route::get('/administrador/empresas', 'AdminsController@empresas');
	Route::get('/administrador/usuarios', 'AdminsController@usuarios');
	Route::get('/administrador/pagos', 'AdminsController@pagos');
	Route::get('/administrador/pagos/Caducados_Expirados', 'AdminsController@Caducados_Expirados');
	Route::get('/administrador/pagos/Caducados_Activos', 'AdminsController@Caducados_Activos');
	
	Route::post ('/administrador/nueva_empresa', 'AdminsController@agregar_empresa');//agregar una nueva empresa
	Route::post ('/administrador/nuevo_pago', 'AdminsController@nuevo_pago' );//agregar un nuevo pago
	Route::post ('/administrador/expirar_pago', 'AdminsController@expirar_pago' );//expira el pago seleccionado
	Route::post ('/administrador/expirar_todos_pagos', 'AdminsController@expirar_todos_pagos' );//expira todos los pagos
});

