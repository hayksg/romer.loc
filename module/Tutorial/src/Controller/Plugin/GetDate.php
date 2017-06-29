<?php

namespace Tutorial\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class GetDate extends AbstractPlugin
{
    public function __invoke()
    {
        $dt = new \DateTime();
        $year = $dt->format('d F Y');
        return $year;
    }
}
