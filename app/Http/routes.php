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

Route::get('emprestimo', 'EmprestimoController@index');

Route::auth();
Route::group(array('before' => 'auth'), function(){
		Route::get('/', 'HomeController@index');
		Route::get('/register', 'UserController@create');
		Route::get('/listausuario', 'UserController@index');
		Route::get('/listapapel', 'RoleController@index');
		Route::get('/listaobjeto', 'PermissionController@index');
		Route::get('/listancm', 'NcmController@index');
		Route::get('/registerpapel', 'RoleController@create');
		Route::get('/registerobjeto', 'PermissionController@create');
		Route::get('/registerpapelusuario{id}', 'UserController@registerpapelusuario');
		Route::get('/registerobjpapel{id}', 'RoleController@createobjpapel');
		Route::post('/inserirpapel', 'RoleController@inserte');
		Route::post('/inserirobjeto', 'PermissionController@inserte');
		Route::post('/inserirpapelusuario', 'UserController@inserirpapelusuario');
		Route::post('/inserirobjpapel', 'RoleController@inserirobjpapel');
		Route::get('/viewusuario{id}', 'UserController@view');
		Route::get('/viewpapel{id}', 'RoleController@view');
		Route::get('/viewobjeto{id}', 'PermissionController@view');
		Route::get('/editeusuario{id}', 'UserController@show');
		Route::get('/editepapel{id}', 'RoleController@show');
		Route::get('/editeobjeto{id}', 'PermissionController@show');
		Route::post('/updateusuario{id}', 'UserController@update');
		Route::post('/updatepapel{id}', 'RoleController@update');
		Route::post('/updateobjeto{id}', 'PermissionController@update');
		Route::get('/deletarusuario{id}', 'UserController@delete');
		Route::get('/deletarpapel{id}', 'RoleController@delete');
		Route::get('/deletarobjeto{id}', 'PermissionController@delete');
		Route::get('/delpapeluser{user_id},{role_id}', 'UserController@deletepapel');
		Route::get('/delobjpapel{permission_id},{role_id}', 'RoleController@deleteobj');
		Route::get('/permissao', 'PainelController@permissaoindex');
		Route::post('/criapermissao', 'PainelController@permissaocreate');
		Route::get('/role', 'PainelController@roleindex');
		Route::post('/criarole', 'PainelController@rolecreate');
		Route::get('/editrole{id}', 'PainelController@roleedita');
		Route::get('/alterar', 'UserController@senha');
		Route::post('/updatesenha', 'UserController@updatesenha');
		Route::get('listancm', 'NcmController@index');
		Route::get('/ncm', 'NcmController@create');
		Route::post('/inserirncm', 'NcmController@inserte');
		Route::get('/deletarncm{id}', 'NcmController@delete');
		Route::get('/editencm{id}', 'NcmController@show');
		Route::post('/updatencm', 'NcmController@update');
		Route::get('/viewncm{id}', 'NcmController@view');
		Route::get('/xml', 'XmlController@create');
		Route::get('listaxml', 'XmlController@index');
		Route::post('/inserirxml', 'XmlController@inserte');
		Route::get('consultaxml', 'XmlController@consultaxml');
		Route::post('calcularxml', 'XmlController@calcularxml');
		Route::get('consultapis', 'XmlController@consultapis');
		Route::post('calcularpis', 'XmlController@calcularpis');
		Route::get('chave', 'CaptchaController@chave');
		Route::post('xmlchave', 'CaptchaController@downloadXml');

		Route::get('xmlarray', 'XmlController@XmltoArray');

		Route::get('noticia', 'NoticiaController@noticias');

		
});





