<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\TaskController;
use Framework\RouteProviderInterface;
use Framework\Router;
use Framework\ServiceContainer;

class RouteProvider implements RouteProviderInterface
{
    public function register(Router $router, ServiceContainer $container): void
    {
        // creating and adding routes for home controller
        $homeController = $container->get(HomeController::class);
        $router->addRoute('GET', '/', [$homeController, 'index']);
        $router->addRoute('GET', '/about', [$homeController, 'about']);

        // creating and adding routes for task controller
        $taskController = $container->get(TaskController::class);
        $router->addRoute('GET', '/tasks', [$taskController, 'index']);
        $router->addRoute('GET', '/tasks/create', [$taskController, 'create']);
    }
}
