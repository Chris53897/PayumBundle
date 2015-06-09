<?php

namespace Payum\Bundle\PayumBundle\DependencyInjection\Factory\Storage;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;


class Propel2StorageFactory  extends AbstractStorageFactory{
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return "propel2";
    }
    
    /**
     * {@inheritDoc}
     */
    public function addConfiguration(ArrayNodeDefinition $builder)
    {
        parent::addConfiguration($builder);     
    }
    
    /**
     * {@inheritDoc}
     */
    protected function createStorage(ContainerBuilder $container, $modelClass, array $config)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../../../Resources/config/storage'));
        $loader->load('propel2.xml');
        
        $storage = new DefinitionDecorator('payum.storage.propel2');
        $storage->setPublic(true);
        $storage->replaceArgument(1, $modelClass);
        
        return $storage;
    }
}
