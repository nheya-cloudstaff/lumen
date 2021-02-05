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

$router->post('/', function () use ($router) {
    return $router->app->version();
});

  $router->post('/auth/login', 'AuthController@postLogin');

$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {

  $router->get('users',  ['uses' => 'UserController@showAllUsers']);
  $router->get('users/{id}', ['uses' => 'UserController@showOneUser']);
  $router->post('users', ['uses' => 'UserController@create']);
  $router->delete('users/{id}', ['uses' => 'UserController@delete']);
  $router->put('users/{id}', ['uses' => 'UserController@update']);

  $router->get('tickets',  ['uses' => 'TicketController@showAllTickets']);
  $router->get('tickets/{id}', ['uses' => 'TicketController@showOneTicket']);
  $router->post('tickets', ['uses' => 'TicketController@create']);
  $router->delete('tickets/{id}', ['uses' => 'TicketController@delete']);
  $router->put('tickets/{id}', ['uses' => 'TicketController@update']);
});
