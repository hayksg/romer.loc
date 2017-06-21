<?php

namespace Tutorial\Controller;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $ctr = new IndexController();
        $ctr->setGreetingService($container->get('greetingService'));
        return $ctr;
    }
}
