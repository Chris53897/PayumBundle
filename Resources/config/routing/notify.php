<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    // Route: payum_notify_do_unsafe
    $routes->add('payum_notify_do_unsafe', '/payment/notify/unsafe/{gateway}')
        ->controller([Payum\Bundle\PayumBundle\Controller\NotifyController::class, 'doUnsafeAction']);

    // Route: payum_notify_do
    $routes->add('payum_notify_do', '/payment/notify/{payum_token}')
        ->controller([Payum\Bundle\PayumBundle\Controller\NotifyController::class, 'doAction']);
};
