<?php

namespace Framework;

class Kernel
{
    public function __construct()
    {
    }

    public function handle(Request $request): Response
    {
        if ($request->path == '/') {
            $response = new Response(body: 'You accessed' . $request->path, responseCode: 200);
        } else {
            $response = new Response(body: 'Resource moved!', responseCode: 301);
        }

        return $response;
    }
}
