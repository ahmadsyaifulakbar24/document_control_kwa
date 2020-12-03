<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use PHPUnit\TextUI\XmlConfiguration\Group;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['namespace' => 'Auth', 'prefix' => 'auth'], function() use ($router) {
    $router->post('login', ['as' => 'login', 'uses' => 'LoginController']);
    $router->post('logout', ['as' => 'logout', 'uses' => 'LogoutController']);
});

$router->group(['middleware' => 'auth'], function() use ($router) {
    $router->group(['namespace' => 'DocumentFlow', 'prefix' => 'document_flow'], function() use ($router) {
        $router->group(['prefix' => 'project'], function() use ($router) {
            $router->post('create', ['as' => 'create_project', 'uses' => 'CreateProjectController']);
        });

        $router->group(['prefix' => 'sub_project'], function() use ($router) {
            $router->post('create', ['as' => 'create_sub_project', 'uses' => 'CreateSubProjectController']);
        });
    });
});