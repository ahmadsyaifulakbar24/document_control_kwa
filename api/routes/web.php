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
        $router->group(['namespace' => 'Project', 'prefix' => 'project'], function() use ($router) {
            $router->get('get', ['as' => 'get_project_all', 'uses' => 'GetProjectController@get_all']);
            $router->get('get/{project_id}', ['as' => 'get_project_by_id', 'uses' => 'GetProjectController@get_by_id']);
            $router->post('create', ['as' => 'create_project', 'uses' => 'CreateProjectController']);
            $router->patch('update/{project_id}', ['as' => 'update_project', 'uses' => 'UpdateProjectController']);
            $router->delete('delete/{project_id}', ['as' => 'delete_project', 'uses' => 'DeleteProjectController']);
        });

        $router->group(['namespace' => 'SubProject', 'prefix' => 'sub_project'], function() use ($router) {
            $router->get('get_by_project/{project_id}', ['as' => 'get_sub_project_by_project', 'uses' => 'GetSubProjectController@get_by_project']);
            $router->get('get/{sub_project_id}', ['as' => 'get_sub_project_by_id', 'uses' => 'GetSubProjectController@get_by_id']);
            $router->post('create', ['as' => 'create_sub_project', 'uses' => 'CreateSubProjectController']);
            $router->delete('delete/{sub_project_id}', ['as' => 'delete_sub_project', 'uses' => 'DeleteSubProjectController']);
            $router->patch('update/{sub_project_id}', ['as' => 'update_sub_project', 'uses' => 'UpdateSubProjectController']);
            $router->post('upload_file/{sub_project_id}', ['as' => 'upload_file_sub_project', 'uses' => 'UploadFileSubProjectController']);
        });
    });
});