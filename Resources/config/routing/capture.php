<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    // Route: payum_capture_do_session
    $routes->add('payum_capture_do_session', '/payment/capture/session-token')
        ->controller([Payum\Bundle\PayumBundle\Controller\CaptureController::class, 'doSessionTokenAction']);

    // Route: payum_capture_do
    $routes->add('payum_capture_do', '/payment/capture/{payum_token}')
        ->controller([Payum\Bundle\PayumBundle\Controller\CaptureController::class, 'doAction']);
};
