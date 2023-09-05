<?php

namespace PuleenoCMS\Dashboard;

use App\Constracts\BackendExtensionConstract;
use App\Constracts\FrontendExtensionConstract;
use App\Core\Extension;
use App\Core\Settings\SettingsInterface;
use App\Http\Middleware\Authenticate;
use PuleenoCMS\Dashboard\Http\Controllers\DashboardController;
use Slim\Routing\RouteCollectorProxy;

class DashboardExtension extends Extension implements FrontendExtensionConstract, BackendExtensionConstract
{
    protected $isBuiltIn = true;

    public function bootstrap()
    {
    }

    public function registerRoutes()
    {
        /** @var SettingsInterface $settings */
        $settings = $this->container->get(SettingsInterface::class);
        $admin_prefix = $settings->get('admin_prefix', 'dashboard');

        $this->app->group($admin_prefix, function (RouteCollectorProxy $group) {
            $group->get('', [DashboardController::class, 'handle'])->setName('dashboardTop');
            $group->get('{pagePath:/?.+}', [DashboardController::class, 'handle']);
        })->add(new Authenticate());
    }
}
