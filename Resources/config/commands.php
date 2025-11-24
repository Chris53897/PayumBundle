<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;

return static function (ContainerConfigurator $container) {
    $services = $container->services();

    // payum.command.create_capture_token
    $services->set(
        'payum.command.create_capture_token',
        Payum\Bundle\PayumBundle\Command\CreateCaptureTokenCommand::class
    )
        ->args([
            new Reference('payum'),
        ])
        ->tag('console.command');

    // payum.command.create_notify_token
    $services->set(
        'payum.command.create_notify_token',
        Payum\Bundle\PayumBundle\Command\CreateNotifyTokenCommand::class
    )
        ->args([
            new Reference('payum'),
        ])
        ->tag('console.command');

    // payum.command.debug_gateway
    $services->set(
        'payum.command.debug_gateway',
        Payum\Bundle\PayumBundle\Command\DebugGatewayCommand::class
    )
        ->args([
            new Reference('payum'),
        ])
        ->tag('console.command');

    // payum.command.status
    $services->set(
        'payum.command.status',
        Payum\Bundle\PayumBundle\Command\StatusCommand::class
    )
        ->args([
            new Reference('payum'),
        ])
        ->tag('console.command');
};
