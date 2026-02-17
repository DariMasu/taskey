<?php

namespace Framework;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class ResponseFactory
{
    private Environment $twig;

    public function __construct(bool $debugMode, string $viewsPath)
    {
        $loader = new FilesystemLoader($viewsPath);
        $this->twig = new Environment($loader, ['cache' => false, 'debug' => $debugMode]);
    }

    /**
     * @param string $template
     * @param array<string> $params
     * @return Response
     */
    public function view(string $template, array $params): Response
    {
        $body = $this->twig->render($template, $params);
        return new Response($body);
    }

    public function notFound(): Response
    {
        return new Response('Page not found', 404);
    }
}
