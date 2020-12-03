<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['namespace' => 'Auth', 'prefix' => 'auth'], function() use ($router) {
    $router->post('login', ['as' => 'login', 'uses' => 'LoginController']);
    $router->post('logout', ['as' => 'logout', 'uses' => 'LogoutController']);
});

$router->group(['namespace' => 'User', 'prefix' => 'user'], function() use ($router) {
    $router->get('/get_user[/{user_id}]', ['as' => 'get_user', 'uses' => 'GetUserController']);
});

$router->group(['namespace' => 'Directory', 'prefix' => 'storage'], function() use ($router) {
    $router->post('/create_folder', ['as' => 'create_folder', 'uses' => 'CreateFolderController']);
    $router->post('/show_folder', ['as' => 'show_folder', 'uses' => 'ShowFolderController']);
    $router->post('/delete_folder', ['as' => 'delete_folder', 'uses' => 'DeleteFolderController']);
    $router->post('/delete_file', ['as' => 'delete_file', 'uses' => 'DeleteFileController']);
    $router->post('/upload_file', ['as' => 'upload_file', 'uses' => 'UploadFileController']);
    $router->post('/get_file', ['as' => 'get_file', 'uses' => 'GetFileController']);
});