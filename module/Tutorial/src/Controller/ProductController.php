<?php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Tutorial\Service\GreetingServiceInterface;

class ProductController extends AbstractActionController
{
    public function indexAction()
    {
        return [

        ];
    }

    public function addAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id', 0);
        return [
            'id' => $id,
        ];
    }

    public function postAddAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        $title = $this->request->getPost('title');

        return [
            'id'    => $id,
            'title' => $title,
        ];

        //return $this->redirect()->toRoute('product');
    }
}
