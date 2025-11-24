<?php

use Payum\Core\Storage\FilesystemStorage;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $parameters = $container->parameters();
    $services   = $container->services();

    $parameters->set('payum.storage.filesystem.class', FilesystemStorage::class);

    $services->set(
        'payum.storage.filesystem.prototype',
        '%payum.storage.filesystem.class%'
    )
        ->public()
        ->abstract()
        ->args([
            null, // wird im FilesystemStorageFactory gesetzt
            null, // wird im FilesystemStorageFactory gesetzt
            null, // wird im FilesystemStorageFactory gesetzt
        ]);
};
