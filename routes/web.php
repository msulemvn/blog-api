
<?php

use Illuminate\Support\Facades\Route;

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

$router->get('/', function () {
    echo '<center> Welcome </center>';
});

$router->get('/version', function () use ($router) {
    return $router->app->version();
});

Route::group([

    'prefix' => 'api',

], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('user-profile', 'AuthController@me');

    Route::get('posts', 'PostController@index');
    Route::post('posts', 'PostController@store');
    Route::get('posts/{post}', 'PostController@show');
    Route::put('posts/{post}', 'PostController@update');
    Route::delete('posts/{post}', 'PostController@destroy');
});
