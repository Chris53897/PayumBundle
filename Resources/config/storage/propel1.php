<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $services = $container->services();

    $services->set(
        'payum.storage.propel1',
        Payum\Core\Bridge\Propel\Storage\Propel1Storage::class
    )
        ->public()
        ->abstract()
        ->args([
            null,   // wird in Propel1StorageFactory ersetzt
        ]);
};
