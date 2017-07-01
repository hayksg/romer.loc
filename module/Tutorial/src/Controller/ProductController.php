<?php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProductController extends AbstractActionController
{
    public function indexAction()
    {

    }

    public function addAction()
    {
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id', 0);
        return [
            'id' => $id,
        ];
    }

    public function addPostAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        $title = $this->request->getPost('title');

        return [
            'id'    => $id,
            'title' => $title,
        ];

        $successMessage = 'Product successfully added';
        $this->flashMessenger()->addSuccessMessage($successMessage);

        /*$errorMessage = 'Can not add product';
        $this->flashMessenger()->addErrorMessage($errorMessage);*/

        //return $this->redirect()->toRoute('product');
    }
}
