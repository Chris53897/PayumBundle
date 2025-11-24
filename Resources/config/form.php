<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;

return static function (ContainerConfigurator $container) {
    $parameters = $container->parameters();
    $services = $container->services();

    /*
     * Parameters
     */
    $parameters
        ->set('payum.available_gateway_factories', []);

    /*
     * Services
     */
    $services->defaults()
        ->public();

    // CreditCardExpirationDateType
    $services->set(
        'payum.form.type.credit_card_expiration_date',
        Payum\Bundle\PayumBundle\Form\Type\CreditCardExpirationDateType::class
    )
        ->tag('form.type');

    // CreditCardType
    $services->set(
        'payum.form.type.credit_card',
        Payum\Bundle\PayumBundle\Form\Type\CreditCardType::class
    )
        ->tag('form.type');

    // GatewayConfigType
    $services->set(
        'payum.form.type.gateway_config',
        Payum\Bundle\PayumBundle\Form\Type\GatewayConfigType::class
    )
        ->args([
            new Reference('payum'),
        ])
        ->tag('form.type');

    // GatewayFactoriesChoiceType
    $services->set(
        'payum.form.type.gateway_factories_choice',
        Payum\Bundle\PayumBundle\Form\Type\GatewayFactoriesChoiceType::class
    )
        ->args([
            '%payum.available_gateway_factories%',
        ])
        ->tag('form.type');

    // GatewayFactoriesChoiceTypeExtension
    $services->set(
        'payum.form.extension.gateway_factories_choice',
        Payum\Bundle\PayumBundle\Form\Extension\GatewayFactoriesChoiceTypeExtension::class
    )
        ->args([
            new Reference('payum'),
        ])
        ->tag('form.type_extension', [
            'extended_type' => Payum\Bundle\PayumBundle\Form\Type\GatewayFactoriesChoiceType::class,
        ]);
};
