<?php

namespace PuleenoCMS\Dashboard\Http\Controllers;

use Psr\Http\Message\ResponseInterface;

class DashboardController extends BaseController
{
    public function handle(ResponseInterface $response): ResponseInterface
    {
        add_filter('title', function($title) {
            return 'Dashboard | ' .  $title;
        });
        return $this->view('dashboard');
    }
}
