<?php

namespace Framework;

class Kernel
{
    private Router $router;

    private ServiceContainer $container;

    private ResponseFactory $responseFactory;

    private ConfigManager $configManager;

    /**
     * @param array<string> $config
     * */
    public function __construct(array $config)
    {
        $this->container = new ServiceContainer();
        $this->configManager = new ConfigManager($config);

        // if env is in production mode, debugging is false and vice versa
        $debugMode = !$this->configManager->isProduction();
        $viewsPath = $this->configManager->get('VIEWS_PATH');

        $this->responseFactory = new ResponseFactory($debugMode, $viewsPath);
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
