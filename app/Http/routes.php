<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get( '/', 'HomeController@index' );
Route::controller( 'home', 'HomeController' );
Route::controller( '/user', 'UserController' );




Route::get( '/restric', function () {

	return view( 'errors.blocked' );

} );


Route::get( 'artisan/{com}', 'ArtisanController@index');
//	Route::controller('/artisan','ArtisanController');
//});

Route::resource( 'spnetapi', 'SpnetapiController' );


include( 'pageroutes.php' );
include( 'moduleroutes.php' );
Route::group( [ 'middleware' => 'auth' ], function () {

	Route::get( 'core/elfinder', 'Core\ElfinderController@getIndex' );
	Route::post( 'core/elfinder', 'Core\ElfinderController@getIndex' );
	Route::controller( '/dashboard', 'DashboardController' );
	Route::controllers( [
		'core/users'    => 'Core\UsersController',
		'notification'  => 'NotificationController',
		'core/logs'     => 'Core\LogsController',
		'core/pages'    => 'Core\PagesController',
		'core/groups'   => 'Core\GroupsController',
		'core/template' => 'Core\TemplateController',
	] );

} );

Route::group( [ 'middleware' => 'auth', 'middleware' => 'spnetauth' ], function () {

	Route::controllers( [
		'spnet/menu'   => 'Spnet\MenuController',
		'spnet/config' => 'Spnet\ConfigController',
		'spnet/module' => 'Spnet\ModuleController',
		'spnet/tables' => 'Spnet\TablesController'
	] );


} );





