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

//$router->group(['middleware'=>'auth:api'], function($router){
$router->group(['prefix'=>'v1'], function($router){
    $router->get('login','UserController@authenticate');
    $router->get('candidates', 'CandidateController@showAllCandidates');
    $router->get('candidates/search', 'CandidateController@searchCandidates');
    $router->get('candidates/{id}', 'CandidateController@showCandidateById');
    $router->post('candidates', 'CandidateController@createCandidate');
});
//});