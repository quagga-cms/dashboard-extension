<?php

namespace Quagga\Extension\Dashboard\Http\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class DashboardController extends BaseController
{
    public function handle(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        add_filter('title', function ($title) {
            return 'Dashboard | ' .  $title;
        });

        return $this->view('dashboard');
    }
}
