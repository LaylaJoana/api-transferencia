<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
// routes users
$router->get('/users', 'UserController@index');
$router->get('/user/{id}', 'UserController@show');
$router->post('/user', 'UserController@createuser');
$router->put('/user/{id}', 'UserController@update');
$router->delete('/user/{id}', 'UserController@delete');

//Routs Transaction
$router->get('/transactions', 'TransactionController@index');
$router->get('/transactions/{id}', 'TransactionController@show');

//Routs Wallets
$router->post('/wallet', 'WalletController@createwallet');
$router->get('/wallet/{id}', 'WalletController@show');
$router->get('/walles', 'WalletController@index');
$router->post('/deposit', 'WalletController@deposit');
$router->post('/transfer', 'WalletController@transfer');



