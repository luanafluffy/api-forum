<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {

    //api/user
    $router->group(['prefix' => 'user'], function () use ($router) {
        $router->post('', 'UserDevController@store');
        $router->get('', 'UserDevController@index');

        //api/user/:id
        $router->group(['prefix' => '{id}'], function () use ($router) {
            $router->get('', 'UserDevController@show');
            $router->patch('', 'UserDevController@update');
            $router->delete('', 'UserDevController@destroy');
        });
    });

    //api/doubt
    $router->group(['prefix' => 'doubt'], function () use ($router) {
        $router->post('', 'DoubtController@store');
        $router->get('', 'DoubtController@index');

        //api/doubt/:id
        $router->group(['prefix' => '{id}'], function () use ($router) {
            $router->get('', 'DoubtController@show');
            $router->put('', 'DoubtController@update');
            $router->delete('', 'DoubtController@destroy');

            //api/doubt/:idDoubt/answer
            $router->group(['prefix' => 'answer'], function () use ($router) {
                $router->post('', 'AnswerController@store');
                $router->get('/details', 'DetailsController@show');
            });
        });

        //api/doubt/answer/:id
        $router->group(['prefix' => 'answer/{id}'], function () use ($router) {
            $router->put('', 'AnswerController@update');
            $router->delete('', 'AnswerController@destroy');
        });
    });
});
