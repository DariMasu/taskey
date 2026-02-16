<?php

namespace Framework;

class Router
{
    /** @var Route[] */
    public array $routes;

    public ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function dispatch(Request $request): Response
    {
        $matchedRoute = null;

        foreach ($this->routes as $route) {
            if ($route->matches($request->method, $request->path)) {
                $matchedRoute = $route;
                break;
            }
        }

        if ($matchedRoute === null) {
            return $this->responseFactory->notFound();
        } else {
            $callback = $matchedRoute->callback;
            return $callback();
        }
    }

    public function addRoute(string $method, string $path, callable $callback): void
    {
        $this->routes[] = new Route($method, $path, $callback);
    }
}
