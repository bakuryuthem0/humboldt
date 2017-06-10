<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::pattern('id', '[0-9]+');
Route::get('/', 'HomeController@getIndex');
Route::get('ver-propiedad/{id}','PublicationController@getPublicationSelf');
Route::get('ver-propiedad/buscar','PublicationController@getSearch');
Route::get('contactenos','ContactController@getPageContact');
Route::get('acerca-de-nosotros','HomeController@getAbout');
Route::get('politicas-de-privacidad','HomeController@getPolicy');
Route::get('preguntas-frecuentes','HomeController@getQuestions');

Route::group(array('before' => 'csrf'),function(){
	Route::post('ver-propiedad/contactar','ContactController@getPubContact');
	Route::get('contactenos/enviar','ContactController@postContact');
});

Route::group(array('before' => 'no_auth'),function(){
	Route::get('administracion/login','AuthController@getAdminLogin');
	Route::group(array('before' => 'csrf'),function(){
		Route::post('administracion/login/enviar','AuthController@postAdminLogin');
	});
});

Route::group(array("before" => "auth"),function(){
	Route::get('administracion','AdminController@getIndex');
	Route::get('administracion/logout','AuthController@getLogout');
	//perfil
	Route::get('administracion/usuario/perfil','UserController@getProfile');
	//usuarios
	Route::get('administracion/usuario/nuevo','AdminController@getNewUser');
	Route::get('administracion/ver-usuarios','AdminController@getUsers');
	//publicaciones
	Route::get('administracion/publicacion/nuevo','PublicationController@getNewPublication');
	Route::get('administracion/ver-publicaciones','PublicationController@getPublications');
	Route::get('administracion/publicaciones/modificar/{id}','PublicationController@getMdfPub');
	//categorias
	Route::get('administracion/categoria/nueva','AdminController@getNewCat');
	Route::get('administracion/ver-categorias','AdminController@getCats');
	Route::get('administracion/categorias/ver-categorias/{id}','AdminController@getCat');
	//Slide / Publicidad
	Route::get('administracion/slider/nuevo','PublicityController@getNewSlide');
	Route::get('administracion/ver-slides','PublicityController@getSlides');
	Route::get('administracion/slides/modificar/{id}','PublicityController@getMdfSlide');
	Route::get('administracion/publicidad/nueva','PublicityController@getPublicity');
	Route::get('administracion/ver-publicidades','PublicityController@getPublicities');
	Route::get('administracion/publicidad/modificar/{id}','PublicityController@getMdfPublicity');
	//contacto
	Route::get('administracion/contacto/ver-contacto','ContactController@getContact');
	Route::get('administracion/contacto/ver-lista','ContactController@getUserEmails');
	//ciudades
	Route::get('administracion/ciudades/nueva','AdminController@getNewFrequentQuestion');
	Route::get('administracion/ver-ciudades','AdminController@getQuestions');
	Route::get('administracion/ciudades/modificar/{id}','AdminController@getMdfQuestion');
	Route::group(array('before' => 'csrf'), function(){
		//perfil
		Route::post('administracion/usuario/perfil/cambiar-contrasena/enviar','UserController@postAdminPass');
		Route::post('administracion/usuario/perfil/enviar','UserController@postAdminProfile');
		//usuarios
		Route::post('administracion/usuario/nuevo/enviar','AdminController@postNewUser');
		Route::post('administracion/cambiar-password','AdminController@poastChangePass');	
		Route::post('administracion/eliminar-usuario','AdminController@postUserElim');
		//categorias
		Route::post('administracion/categoria/nueva/enviar','AdminController@postNewCat');
		Route::post('administracion/categorias/ver-categorias/{id}/enviar','AdminController@postMdfCat');
		Route::post('administracion/categorias/eliminar','AdminController@postElimCat');
		//publicacion
		Route::post('administracion/producto/nuevo/enviar','PublicationController@postNewPub');
		Route::get('administracion/publicaciones/cargar-detalles','PublicationController@getPublicationDetails');
		Route::post('administracion/publicaciones/modificar/{id}/enviar','PublicationController@postMdfPublication');
		Route::post('administracion/publicaciones/modificar/eliminar-imagen','PublicationController@postElimPubImg');
		Route::post('administracion/ver-publicaciones/eliminar','PublicationController@postElimPub');
		//publicidad
		Route::post('administracion/slider/nuevo/enviar','PublicityController@postNewSlide');
		Route::post('administracion/slider/{id}/enviar','PublicityController@postMdfSlide');
		Route::post('administracion/ver-slides/eliminar','PublicityController@postElimSlide');
		Route::post('administracion/publicidad/nueva/enviar','PublicityController@postPublicity');
		Route::post('administracion/publicidad/modificar/{id}/enviar','PublicityController@postMdfPub');
		Route::post('administracion/ver-publicidad/eliminar','PublicityController@postPublicityElim');
		//ciudades
		Route::post('administracion/ciudades/nueva/enviar','AdminController@postNewFrequentQuestion');
		Route::post('administracion/ciudades/modificar/{id}/enviar','AdminController@postMdfQuestion');
		Route::post('administracion/ciudades/eliminar','AdminController@postElimQuestion');


	});
});