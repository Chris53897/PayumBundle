<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $services = $container->services();

    $services->set(
        'payum.storage.propel2',
        Payum\Core\Bridge\Propel2\Storage\Propel2Storage::class
    )
        ->public()
        ->abstract()
        ->args([
            null,   // soll in Propel2StorageFactory ersetzt werden
        ]);
};
