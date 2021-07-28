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

//Gestão de Dashboard
Route::group(['prefix' => 'painel', 'middleware' => ['auth'], 'web'], function($route){

    //Estilos musicais
    $route->get('estilos', 'Painel\EstiloController@index');
    $route->get('estilos/cadastrar', 'Painel\EstiloController@cad');
    $route->post('estilos/cadastrar', 'Painel\EstiloController@cadGo');
    $route->get('estilos/editar/{id}', 'Painel\EstiloController@edit');
    $route->post('estilos/editar/{id}', 'Painel\EstiloController@editGo');
    $route->get('estilos/deletar/{id}', 'Painel\EstiloController@delete');
    $route->post('estilos/pesquisar', 'Painel\EstiloController@pesquisar');

    //Álbum
    $route->get('albuns', 'Painel\AlbumController@index');
    $route->get('album/cadastrar', 'Painel\AlbumController@cad');
    $route->post('album/cadastrar', 'Painel\AlbumController@cadGo');
    $route->get('album/editar/{id}', 'Painel\AlbumController@edit');
    $route->post('album/editar/{id}', 'Painel\AlbumController@editGo');
    $route->get('album/deletar/{id}', 'Painel\AlbumController@deleteAlbum');
    $route->post('album/pesquisar', 'Painel\AlbumController@pesquisar');

    //Músicas
    $route->get('musicas', 'Painel\MusicaController@index');
    $route->get('musica/cadastrar', 'Painel\MusicaController@cadMusica');
    $route->post('musica/cadastrar', 'Painel\MusicaController@cadGo');
    $route->get('musica/editar/{id}', 'Painel\MusicaController@edit');
    $route->post('musica/editar/{id}', 'Painel\MusicaController@editGo');
    $route->get('musica/deletar/{id}', 'Painel\MusicaController@deletarMusica');
    $route->post('musica/pesquisar', 'Painel\MusicaController@pesquisar');

    //Gestão de usuários
    $route->get('usuarios', 'Painel\UserController@index');
    $route->get('user/cadastrar', 'Painel\UserController@cad');
    $route->post('user/cadastrar', 'Painel\UserController@cadGo');
    $route->get('user/editar/{id}', 'Painel\UserController@edit');
    $route->post('user/editar/{id}', 'Painel\UserController@editGo');
    $route->get('user/deletar/{id}', 'Painel\UserController@delete');
    $route->post('usuarios/pesquisar', 'Painel\UserController@pesquisar');

    //Albuns <=> Musicas
    $route->get('album/musicas/{id}', 'Painel\AlbumController@musicas');
    $route->get('album/{id}/musicas/cadastrar', 'Painel\AlbumController@musicasCadastrar');
    $route->post('album/{id}/musicas/cadastrar', 'Painel\AlbumController@musicasCadastrarGo');
    $route->get('album/{idAlbum}/musicas/deletar/{idMusica}', 'Painel\AlbumController@deletarMusicaAlbum');
    $route->post('album/musicas/{id}', 'Painel\AlbumController@musicaPesquisar');
    $route->post('album/{id}/musicas/pesquisar', 'Painel\AlbumController@pesquisarMusicaAdd');

    //Rota inicial do Dashboard
    $route->get('/', 'Painel\PainelController@index');
});

//----------------------------------------------------------------------------

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//----------------------------------------------------------------------------
//Listagem dos albuns de um determinado estilo musical
Route::get('estilo/{id}', 'Site\SiteController@albunsEstilo');

//Filtra os albuns
Route::post('/albuns/pesquisar', 'Site\SiteController@albumPesquisar');

//Mostra as músicas do album
Route::get('/albuns/{id}', 'Site\SiteController@musicasAlbum');


//----------------------------------------------------------------------------
//Homepage do LaraMusic
Route::get('/', 'Site\SiteController@index');
