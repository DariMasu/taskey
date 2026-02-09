<?php

require __DIR__ . "/../vendor/autoload.php";

use Framework\Kernel;
use Framework\Request;
use App\RouteProvider;
use App\ServiceProvider;

$kernel = new Kernel();

// registering services
$serviceProvider = new ServiceProvider();
$kernel->registerServices($serviceProvider);

// registering routes
$routeProvider = new RouteProvider();
$kernel->registerRoutes($routeProvider);

// extract path from the uri
$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (!is_string($urlPath)) {
    $urlPath = '/';
}

// getting a new request
$request = new Request($_SERVER['REQUEST_METHOD'], $urlPath, $_GET, $_POST);

$response = $kernel->handle($request);

$response->echo();
