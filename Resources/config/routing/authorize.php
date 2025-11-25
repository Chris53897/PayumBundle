<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add('payum_authorize_do', '/payment/authorize/{payum_token}')
        ->controller([Payum\Bundle\PayumBundle\Controller\AuthorizeController::class, 'doAction']);
};
