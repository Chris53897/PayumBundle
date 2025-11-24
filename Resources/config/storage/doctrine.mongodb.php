<?php

use Doctrine\ODM\MongoDB\DocumentManager;
use Payum\Core\Bridge\Doctrine\Storage\DoctrineStorage;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;

return static function (ContainerConfigurator $container) {
    $parameters = $container->parameters();
    $services   = $container->services();

    $parameters->set('payum.storage.doctrine.mongodb.class', DoctrineStorage::class);

    $services->set(
        'payum.storage.doctrine.mongodb',
        '%payum.storage.doctrine.mongodb.class%'
    )
        ->public()
        ->abstract()
        ->args([
            new Reference('payum.document_manager'),
            null, // wird in DoctrineStorageFactory gesetzt
        ]);

    $services->set(
        'payum.document_manager',
        DocumentManager::class
    )
        ->public()
        ->factory([new Reference('doctrine_mongodb'), 'getManager']);
};
