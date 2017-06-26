<?php

namespace Tutorial\Event;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class GreetingServiceListenerAggregateFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $greetingListenerAggregate = new GreetingServiceListenerAggregate();
        $greetingListenerAggregate->setSomeEventService($container->get('someEventService'));
        return $greetingListenerAggregate;
    }
}
