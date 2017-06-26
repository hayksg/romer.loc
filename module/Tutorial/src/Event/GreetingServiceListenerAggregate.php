<?php

namespace Tutorial\Event;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Tutorial\Service\SomeEventServiceInterface;
use Zend\EventManager\EventInterface;

class GreetingServiceListenerAggregate implements ListenerAggregateInterface
{
    private $setSomeEventService;
    private $listeners = [];

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach('getGreeting', [$this, 'firstEvent'],  $priority);
        $this->listeners[] = $events->attach('getGreeting', [$this, 'secondEvent'], $priority);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            $events->detach($listener);
            unset($this->listeners[$index]);
        }
    }

    public function setSomeEventService(SomeEventServiceInterface $setSomeEventService)
    {
        $this->setSomeEventService = $setSomeEventService;
    }

    public function getSomeEventService()
    {
        return $this->setSomeEventService;
    }

    public function firstEvent(EventInterface $e)
    {
        $params = $e->getParams();
        $this->getSomeEventService()->onGetGreeting($params);
    }

    public function secondEvent(EventInterface $e)
    {
        $params = $e->getParams();
        $this->getSomeEventService()->onGetGreeting($params);
    }
}
