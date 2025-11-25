<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add('payum_refund_do', '/payment/refund/{payum_token}')
        ->controller([Payum\Bundle\PayumBundle\Controller\RefundController::class, 'doAction']);
};
