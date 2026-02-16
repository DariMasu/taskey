<?php

namespace Framework;

class ResponseFactory
{
    public function body(string $body): Response
    {
        return new Response($body);
    }

    public function notFound(): Response
    {
        return new Response('Page not found', 404);
    }
}
