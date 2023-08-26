<?php

namespace PuleenoCMS\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Psr\Http\Message\ResponseInterface;

class DashboardController extends Controller
{
    public function handle(ResponseInterface $response): ResponseInterface {
        return $response;
    }
}
