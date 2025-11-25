<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add('payum_sync_do', '/payment/sync/{payum_token}')
        ->controller([Payum\Bundle\PayumBundle\Controller\SyncController::class, 'doAction']);
};
