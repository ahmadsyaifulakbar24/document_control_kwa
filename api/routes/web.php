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
    $router->get('provinsi/get', ['as' => 'get_provinsi', 'uses' => 'ProvinsiController@getAll']);
    $router->get('kab_kota/get/{provinsi_id}', ['as' => 'get_kab_kota', 'uses' => 'KabKotaController@get_by_provinsi_id']);
    $router->group(['namespace' => 'User', 'prefix' => 'user'], function() use ($router) {
        $router->get('get_user', ['as' => 'get_user', 'uses' => 'GetUserController']);
        $router->get('get_user_project', ['as' => 'get_user_project', 'uses' => 'GetUserController@get_user_for_project']);
    });
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

    $router->group(['namespace' => 'Ppjab', 'prefix' => 'ppjab'], function() use ($router) { 
        $router->group(['namespace' => 'Ppjab'], function() use ($router) {
            $router->post('create', ['as' => 'create_ppjab', 'uses' => 'CreatePpjabController']);
            $router->get('get', ['as' => 'get_ppjab', 'uses' => 'GetPpjabController@get_all']);
            $router->get('get/{ppjab_id}', ['as' => 'get_ppjab_by_id', 'uses' => 'GetPpjabController@get_by_id']);
            $router->patch('update/{ppjab_id}', ['as' => 'update_ppjab', 'uses' => 'UpdatePpjabController']);
            $router->delete('delete/{ppjab_id}', ['as' => 'delete_ppjab', 'uses' => 'DeletePpjabController']);
         });

        $router->group(['namespace' => 'DocumentPpjab', 'prefix' => 'document_ppjab'], function() use ($router) {
            $router->post('create', ['as' => 'create_document_ppjab', 'uses' => 'CreateDocumentPpjabController']);
            $router->get('get/{document_ppjab_id}', ['as' => 'get_document_ppjab_by_id', 'uses' => 'GetDocumentPpjabController@get_by_id']);
            $router->get('list_group', ['as' => 'get_document_ppjab_list_group', 'uses' => 'GetDocumentPpjabController@list_group']);
            $router->get('list_sub_group/{group_id}', ['as' => 'get_document_ppjab_list_sub_group', 'uses' => 'GetDocumentPpjabController@list_sub_group']);
            $router->get('get_by_group/{ppjab_id}/{group_id}', ['as' => 'get_document_ppjab_by_group', 'uses' => 'GetDocumentPpjabController@get_by_ppjab_group']);
            $router->delete('delete/{document_ppjab_id}', ['as' => 'delete_document_ppjab', 'uses' => 'DeleteDocumentPpjabController']);
        });
    });

    $router->group(['namespace' => 'Kontrak', 'prefix' => 'kontrak'], function() use ($router) { 
        $router->group(['namespace' => 'Kontrak'], function() use ($router) { 
            $router->post('/create', ['as' => 'create_kontrak', 'uses' => 'CreateKontrakController']);
            $router->post('/update/{kontrak_id}', ['as' => 'update_kontrak', 'uses' => 'UpdateKontrakController']);
            $router->get('/get', ['as' => 'get_kontrak', 'uses' => 'GetKontrakController@get_all']);
            $router->get('/get/{kontrak_id}', ['as' => 'get_kontrak_by_id', 'uses' => 'GetKontrakController@get_by_id']);
            $router->delete('/delete/{kontrak_id}', ['as' => 'delete_kontrak', 'uses' => 'DeleteKontrakController']);
        });

        $router->group(['namespace' => 'Amandemen', 'prefix' => 'amandemen'], function() use ($router) {
            $router->get('/get/{kontrak_id}', ['as' => 'get_amandemen', 'uses' => 'GetAmandemenController@get_all']);
            $router->get('/get_by_id/{amandemen_id}', ['as' => 'get_amandemen_by_id', 'uses' => 'GetAmandemenController@get_by_id']);
            $router->post('/create', ['as' => 'create_amandemen', 'uses' => 'CreateAmandemenController']);
            $router->post('/update/{amandemen_id}', ['as' => 'update_amandemen', 'uses' => 'UpdateAmandemenController']);
            $router->delete('/delete/{amandemen_id}', ['as' => 'delete_amandemen', 'uses' => 'DeleteAmandemenController']);
        });
    });
});