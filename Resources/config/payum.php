<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;

return static function (ContainerConfigurator $container) {
    $services = $container->services();
    $parameters = $container->parameters();

    /*
     * Parameters
     */
    $parameters
        ->set('payum.capture_path', 'payum_capture_do')
        ->set('payum.notify_path', 'payum_notify_do')
        ->set('payum.authorize_path', 'payum_authorize_do')
        ->set('payum.refund_path', 'payum_refund_do')
        ->set('payum.cancel_path', 'payum_cancel_do')
        ->set('payum.payout_path', 'payum_payout_do');

    /*
     * Services
     */
    $services->defaults()
        ->public();

    // payum.builder
    $services->set('payum.builder', Payum\Core\PayumBuilder::class)
        ->public(false)
        ->call('setMainRegistry', [
            new Reference('payum.static_registry')
        ])
        ->call('setHttpRequestVerifier', [
            new Reference('payum.http_request_verifier_builder')
        ])
        ->call('setTokenFactory', [
            new Reference('payum.token_factory_builder')
        ])
        ->call('setTokenStorage', [
            new Reference('payum.security.token_storage')
        ])
        ->call('setGenericTokenFactoryPaths', [[
            'capture' => '%payum.capture_path%',
            'notify' => '%payum.notify_path%',
            'authorize' => '%payum.authorize_path%',
            'refund' => '%payum.refund_path%',
            'cancel' => '%payum.cancel_path%',
            'payout' => '%payum.payout_path%',
        ]])
        ->call('setCoreGatewayFactory', [
            new Reference('payum.core_gateway_factory_builder')
        ]);

    // payum
    $services->set('payum', Payum\Core\Payum::class)
        ->lazy()
        ->factory([new Reference('payum.builder'), 'getPayum']);

    // alias
    $services->alias(Payum\Core\Payum::class, 'payum');

    // static registry
    $services->set('payum.static_registry', Payum\Bundle\PayumBundle\ContainerAwareRegistry::class)
        ->args([
            [], // gateways
            [], // storages
            [], // gateway factories
        ])
        ->call('setContainer', [
            new Reference('service_container')
        ]);

    // converters + listeners
    $services->set('payum.converter.reply_to_http_response', Payum\Bundle\PayumBundle\ReplyToSymfonyResponseConverter::class);

    $services->set('payum.listener.reply_to_http_response', Payum\Bundle\PayumBundle\EventListener\ReplyToHttpResponseListener::class)
        ->args([
            new Reference('payum.converter.reply_to_http_response'),
        ])
        ->tag('kernel.event_listener', [
            'event' => 'kernel.exception',
            'method' => 'onKernelException',
            'priority' => 128,
        ]);

    // token storage (abstract)
    $services->set('payum.security.token_storage')
        ->abstract();

    // Extensions
    $services->set('payum.extension.storage.prototype', Payum\Core\Extension\StorageExtension::class)
        ->abstract()
        ->private()
        ->args([
            null, // wird später ersetzt
        ]);

    $services->set('payum.extension.logger', Payum\Core\Bridge\Psr\Log\LoggerExtension::class)
        ->args([
            new Reference('logger'),
        ])
        ->tag('monolog.logger', ['channel' => 'payum'])
        ->tag('payum.extension', ['all' => true, 'alias' => 'psr_logger']);

    // Builders
    $services->set('payum.token_factory_builder', Payum\Bundle\PayumBundle\Builder\TokenFactoryBuilder::class)
        ->private()
        ->args([
            new Reference('router'),
        ]);

    $services->set('payum.http_request_verifier_builder', Payum\Bundle\PayumBundle\Builder\HttpRequestVerifierBuilder::class)
        ->private();

    $services->set('payum.core_gateway_factory_builder', Payum\Bundle\PayumBundle\Builder\CoreGatewayFactoryBuilder::class)
        ->private()
        ->call('setContainer', [
            new Reference('service_container')
        ]);

    $services->set('payum.action.obtain_credit_card_builder', Payum\Bundle\PayumBundle\Builder\ObtainCreditCardActionBuilder::class)
        ->args([
            new Reference('form.factory'),
            new Reference('request_stack'),
        ]);

    $services->set('payum.action.get_http_request', Payum\Bundle\PayumBundle\Action\GetHttpRequestAction::class)
        ->call('setHttpRequestStack', [
            new Reference('request_stack'),
        ]);
};
