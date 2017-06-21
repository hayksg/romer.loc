<?php

namespace Tutorial;

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
                'greetingService' => Service\GreetingService::class,
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\IndexController::class => Controller\IndexControllerFactory::class,
            ],
        ];
    }
}
