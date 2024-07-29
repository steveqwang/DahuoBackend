<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('/setting', SettingController::class);
    $router->resource('/banner', BannerController::class);
    $router->resource('/activity-type', ActivityTypeController::class);
    $router->resource('/dazi-type', DaziTypeController::class);
    $router->resource('/dazi-bia', DaziBiaController::class);
    $router->resource('/interest', InterestController::class);
    $router->resource('/activity', ActivityController::class);
    $router->resource('/user', UserController::class);
    $router->resource('/user-ti', UserTiController::class);
});
