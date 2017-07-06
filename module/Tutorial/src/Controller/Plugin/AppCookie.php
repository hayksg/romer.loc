<?php

namespace Tutorial\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Http\Header\SetCookie;

class AppCookie extends AbstractPlugin
{
    public function addCookie($name, $value, $obj)
    {
        $cookie = new SetCookie($name, $value, time() + 3600 * 24 * 100, '/');
        $obj->getResponse()->getHeaders()->addHeader($cookie);
    }

    public function getCookie($name, $obj)
    {
        $message = '';
        $cookie = $obj->getRequest()->getCookie();

        if ($cookie && $cookie->offsetExists($name)) {
            $message = $cookie->offsetGet($name);

            $cookie = new setCookie($name, '', time() - 3600, '/');
            $obj->getResponse()->getHeaders()->addHeader($cookie);
        }

        return $message;
    }
}
