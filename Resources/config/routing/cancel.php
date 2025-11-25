<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add('payum_cancel_do', '/payment/cancel/{payum_token}')
        ->controller([Payum\Bundle\PayumBundle\Controller\CancelController::class, 'doAction']);
};
