<?php

namespace Tutorial\View\Helper;

use Zend\View\Helper\AbstractHelper;

class GetTime extends AbstractHelper
{
    public function __invoke()
    {
        $dt = new \DateTime('now', new \DateTimeZone('Asia/Yerevan'));
        return $dt->format('H:i:s');
    }
}
