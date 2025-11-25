<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add('payum_payout_do', '/payment/payout/{payum_token}')
        ->controller([Payum\Bundle\PayumBundle\Controller\PayoutController::class, 'doAction']);
};
