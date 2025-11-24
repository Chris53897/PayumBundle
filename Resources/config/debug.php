<?php

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;

return static function (ContainerConfigurator $container) {
    $services = $container->services();

    $services->defaults()
        ->public();

    $services->set(
        'payum.extension.log_executed_actions',
        Payum\Core\Bridge\Psr\Log\LogExecutedActionsExtension::class
    )
        ->args([
            (new Reference('logger', ContainerInterface::IGNORE_ON_INVALID_REFERENCE)),
        ])
        ->tag('monolog.logger', ['channel' => 'payum'])
        ->tag('payum.extension', [
            'all' => true,
            'alias' => 'log_executed_actions',
        ]);

    $services->set(
        'payum.profiler.payum_collector',
        Payum\Bundle\PayumBundle\Profiler\PayumCollector::class
    )
        ->tag('payum.extension', [
            'all' => true,
            'alias' => 'profile_collector',
            'prepend' => true,
        ])
        ->tag('data_collector', [
            'template' => '@Payum/Profiler/payum.html.twig',
            'id' => 'payum',
        ]);
};
