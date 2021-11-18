<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api', 'middleware' => 'autenticador'], function () use ($router) {

    //api/user
    $router->group(['prefix' => 'user'], function () use ($router) {
        $router->get('', 'UserController@index');

        //api/user/:id
        $router->group(['prefix' => '{id}'], function () use ($router) {
            $router->get('', 'UserController@show');
            $router->patch('', 'UserController@update');
            $router->delete('', 'UserController@destroy');
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

$router->group(['prefix' => '/api'], function () use ($router) {
    $router->post('/login', 'TokenController@generatorToken');
    $router->post('/register', 'UserController@store');
});
