<?php

namespace Payum\Bundle\PayumBundle\Extension;

use Payum\Bundle\PayumBundle\Event\ExecuteEvent;
use Payum\Bundle\PayumBundle\PayumEvents;
use Payum\Core\Extension\Context;
use Payum\Core\Extension\ExtensionInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class EventDispatcherExtension implements ExtensionInterface
{
    private EventDispatcherInterface $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function onPreExecute(Context $context): void
    {
        $event = new ExecuteEvent($context);
        $this->dispatcher->dispatch($event, PayumEvents::GATEWAY_PRE_EXECUTE);
    }

    public function onExecute(Context $context): void
    {
        $event = new ExecuteEvent($context);
        $this->dispatcher->dispatch($event, PayumEvents::GATEWAY_EXECUTE);
    }

    public function onPostExecute(Context $context): void
    {
        $event = new ExecuteEvent($context);
        $this->dispatcher->dispatch($event, PayumEvents::GATEWAY_POST_EXECUTE);
    }
}
