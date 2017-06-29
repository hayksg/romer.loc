<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $url = $this->url()->fromRoute();
        return new ViewModel([
            'url' => $url,
            'date' => $this->getDate(),
        ]);
    }
}
