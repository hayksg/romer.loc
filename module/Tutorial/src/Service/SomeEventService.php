<?php

namespace Tutorial\Service;

use Tutorial\Service\SomeEventServiceInterface;

class SomeEventService implements SomeEventServiceInterface
{
    public function onGetGreeting($params)
    {
        echo "Some event on 'getGreeting' service with hour = {$params['hour']}";
    }
}
