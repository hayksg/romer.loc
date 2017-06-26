<?php

namespace Tutorial;

use Tutorial\Controller\IndexController;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;

class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'invokables' => [
                'someEventService' => Service\SomeEventService::class,
            ],
            'factories' => [
                'greetingService'  => Service\GreetingServiceFactory::class,
                'greetingServiceListenerAggregate'  => Event\GreetingServiceListenerAggregateFactory::class,
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\IndexController::class => function ($container) {
                    $ctr = new IndexController();
                    $ctr->setGreetingService($container->get('greetingService'));
                    return $ctr;
                },
            ],
        ];
    }

    /*public function init(ModuleManager $e)
    {
        $e->getEventManager()->getSharedManager()->attach(
            __NAMESPACE__,
            'dispatch',
            [$this, 'onInit']
        );
    }

    public function onInit()
    {
        echo __METHOD__;
    }*/

    /*public function onBootstrap(MvcEvent $e)
    {
        $e->getApplication()->getEventManager()->getSharedManager()->attach(
            __NAMESPACE__,
            'dispatch',
            function ($e) {
                $controller = $e->getTarget();
                $controller->layout('layout/defaultLayout');
            },
            100
        );
    }*/
}
