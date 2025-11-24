<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;

return static function (ContainerConfigurator $container) {
    $services = $container->services();

    /*
     * Abstract PayumController base
     */
    $services->set(
        Payum\Bundle\PayumBundle\Controller\PayumController::class,
        Payum\Bundle\PayumBundle\Controller\PayumController::class
    )
        ->abstract()
        ->args([
            new Reference('payum'),
        ]);

    /*
     * AuthorizeController
     */
    $services->set(
        Payum\Bundle\PayumBundle\Controller\AuthorizeController::class,
        Payum\Bundle\PayumBundle\Controller\AuthorizeController::class
    )
        ->parent(Payum\Bundle\PayumBundle\Controller\PayumController::class)
        ->public()
        ->autowire()
        ->tag('container.service_subscriber');

    /*
     * CancelController
     */
    $services->set(
        Payum\Bundle\PayumBundle\Controller\CancelController::class,
        Payum\Bundle\PayumBundle\Controller\CancelController::class
    )
        ->parent(Payum\Bundle\PayumBundle\Controller\PayumController::class)
        ->public()
        ->autowire()
        ->tag('container.service_subscriber');

    /*
     * CaptureController
     */
    $services->set(
        Payum\Bundle\PayumBundle\Controller\CaptureController::class,
        Payum\Bundle\PayumBundle\Controller\CaptureController::class
    )
        ->parent(Payum\Bundle\PayumBundle\Controller\PayumController::class)
        ->public()
        ->autowire()
        ->tag('container.service_subscriber');

    /*
     * NotifyController
     */
    $services->set(
        Payum\Bundle\PayumBundle\Controller\NotifyController::class,
        Payum\Bundle\PayumBundle\Controller\NotifyController::class
    )
        ->parent(Payum\Bundle\PayumBundle\Controller\PayumController::class)
        ->public()
        ->autowire()
        ->tag('container.service_subscriber');

    /*
     * PayoutController
     */
    $services->set(
        Payum\Bundle\PayumBundle\Controller\PayoutController::class,
        Payum\Bundle\PayumBundle\Controller\PayoutController::class
    )
        ->parent(Payum\Bundle\PayumBundle\Controller\PayumController::class)
        ->public()
        ->autowire()
        ->tag('container.service_subscriber');

    /*
     * RefundController
     */
    $services->set(
        Payum\Bundle\PayumBundle\Controller\RefundController::class,
        Payum\Bundle\PayumBundle\Controller\RefundController::class
    )
        ->parent(Payum\Bundle\PayumBundle\Controller\PayumController::class)
        ->public()
        ->autowire()
        ->tag('container.service_subscriber');

    /*
     * SyncController
     */
    $services->set(
        Payum\Bundle\PayumBundle\Controller\SyncController::class,
        Payum\Bundle\PayumBundle\Controller\SyncController::class
    )
        ->parent(Payum\Bundle\PayumBundle\Controller\PayumController::class)
        ->public()
        ->autowire()
        ->tag('container.service_subscriber');
};
