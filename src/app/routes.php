<?php

namespace App\controller;

use Slim\Routing\RouteCollectorProxy;


$app->group('/producto', function(RouteCollectorProxy $producto)
{

$producto->post('',Producto::class . ':crear'); //


});


