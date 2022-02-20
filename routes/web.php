<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->get('/', function () use ($router) {
    return '1.0';
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/books', [
        'as' => 'books.get',
        'uses' => 'BooksController@index'
    ]);
});
