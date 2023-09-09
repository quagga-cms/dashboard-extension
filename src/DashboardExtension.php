<?php

namespace PuleenoCMS\Dashboard;

use App\Constracts\BackendExtensionConstract;
use App\Constracts\FrontendExtensionConstract;
use App\Core\Extension;
use App\Core\ExtensionManager;
use App\Core\HookManager;
use App\Core\Settings\SettingsInterface;
use App\Http\Middleware\Authenticate;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use PuleenoCMS\Dashboard\Http\Controllers\DashboardController;
use Slim\Routing\RouteCollectorProxy;

class DashboardExtension extends Extension implements FrontendExtensionConstract, BackendExtensionConstract
{
    protected $isBuiltIn = true;

    public function bootstrap()
    {
        /**
         * @var \PuleenoCMS\React\ReactExtension
         */
        $react = ExtensionManager::getExtension('puleeno-cms/react');
    }

    public function registerRoutes()
    {
        /** @var SettingsInterface $settings */
        $settings = $this->container->get(SettingsInterface::class);
        $admin_prefix = $settings->get('admin_prefix', 'dashboard');
        $app = &$this->app;
        $container = &$this->container;

        $this->app->group($admin_prefix, function (RouteCollectorProxy $group) use($app, $settings) {
            $group->get('', [DashboardController::class, 'handle'])->setName('dashboardTop');
            $group->get('{pagePath:/?.+}', [DashboardController::class, 'handle']);

            // Support custom dashboard or register dashboard content by other extensions
            HookManager::executeAction('setup_dashboard', $group, $app, $settings);
        })
            ->add(new Authenticate());
    }
}
