<?php

namespace App\Controllers;

use Framework\Response;

class TaskController
{
    public function index(): Response
    {
        return new Response('listing all tasks');
    }

    public function create(): Response
    {
        return new Response('creating a task');
    }
}
