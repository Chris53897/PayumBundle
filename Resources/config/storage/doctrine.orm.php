<?php

use Payum\Core\Bridge\Doctrine\Storage\DoctrineStorage;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;

return static function (ContainerConfigurator $container) {
    $parameters = $container->parameters();
    $services   = $container->services();

    $parameters->set('payum.storage.doctrine.orm.class', DoctrineStorage::class);

    $services->set(
        'payum.storage.doctrine.orm',
        '%payum.storage.doctrine.orm.class%'
    )
        ->public()
        ->abstract()
        ->args([
            new Reference('payum.entity_manager'),
            null, // wird später in DoctrineStorageFactory gesetzt
        ]);

    $services->alias(
        'payum.entity_manager',
        'doctrine.orm.default_entity_manager'
    )->public();
};
