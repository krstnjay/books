<?php

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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/books',['uses' => 'BooksController@getBooks']);
});

$router->get('/books', 'BooksController@index'); // get all books records
$router->post('/books', 'BooksController@add'); // create new book record
$router->get('/books/{id}', 'BooksController@show'); // get book by id
$router->put('/books/{id}', 'BooksController@update'); // update book record
$router->delete('/books/{id}', 'BooksController@delete'); // delete record

?>