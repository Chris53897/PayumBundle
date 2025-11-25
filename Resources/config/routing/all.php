<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->import('@PayumBundle/Resources/config/routing/capture.php');
    $routes->import('@PayumBundle/Resources/config/routing/authorize.php');
    $routes->import('@PayumBundle/Resources/config/routing/notify.php');
    $routes->import('@PayumBundle/Resources/config/routing/payout.php');
    $routes->import('@PayumBundle/Resources/config/routing/refund.php');
    $routes->import('@PayumBundle/Resources/config/routing/sync.php');
    $routes->import('@PayumBundle/Resources/config/routing/cancel.php');
};
