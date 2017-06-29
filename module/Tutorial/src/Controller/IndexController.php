<?php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Tutorial\Service\GreetingServiceInterface;

class IndexController extends AbstractActionController
{
    private $greetingService;

    /*public function onDispatch(MvcEvent $e)
    {
        $this->layout('layout/defaultLayout');
        return parent::onDispatch($e);
    }*/

    public function indexAction()
    {
        if ($this->request->isPost()) {
            $this->prg();
        }

        return new ViewModel([
            #'greeting' => $this->getGreetingService()->getGreeting(),
            'greeting' => 'Hello',
        ]);
    }

    public function setGreetingService(GreetingServiceInterface $greetingService)
    {
        $this->greetingService = $greetingService;
    }

    public function getGreetingService()
    {
        return $this->greetingService;
    }

    public function sampleAction()
    {
        //return $this->redirect()->toUrl('http://bing.com');
        //$this->layout('layout/defaultLayout');
        //return $this->forward()->dispatch(\Application\Controller\IndexController::class, ['action' => 'index']);

        /*$successMessage = 'Success message';
        $this->flashMessenger()->addSuccessMessage($successMessage);*/

        /*$errorMessage = 'Error message';
        $this->flashMessenger()->addErrorMessage($errorMessage);*/
        //return $this->redirect()->toRoute('home');

        $widget = $this->forward()->dispatch(\Application\Controller\IndexController::class, ['action' => 'index']);

        $view = new ViewModel();
        $view->addChild($widget, 'widget');
        //$view->setTemplate('tutorial/index/sampleTemplate');
        return $view;
    }
}
