<?php

namespace Framework;

class Kernel
{
    private Router $router;

    private ServiceContainer $container;

    private ResponseFactory $responseFactory;

    public function __construct()
    {
        $this->container = new ServiceContainer();
        $this->responseFactory = new ResponseFactory();
        $this->container->set(ResponseFactory::class, $this->responseFactory);
        $this->router = new Router($this->responseFactory);
    }

    public function handle(Request $request): Response
    {
        return $this->router->dispatch($request);
    }

    public function registerRoutes(RouteProviderInterface $routeProvider): void
    {
        $routeProvider->register($this->router, $this->container);
    }

    public function registerServices(ServiceProviderInterface $serviceProvider): void
    {
        $serviceProvider->register($this->container);
    }
}
