<?php

namespace Tutorial\Controller;

use Zend\Http\Header\SetCookie;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Tutorial\Service\GreetingServiceInterface;
use Zend\Session\Container;

class ArticleController extends AbstractActionController
{
    public function indexAction()
    {
        $message = '';
        /*$container = new Container('add_product');
        $message = $container->message;
        $container->getManager()->getStorage()->clear('add_product');*/

        $message = $this->appGetCookie('addProduct');

        /*if ($this->request->isPost()) {
            $this->prg();
        }*/

        return new ViewModel([
            #'greeting' => $this->getGreetingService()->getGreeting(),
            'greeting' => 'Hello',
            'message'  => $message,
        ]);
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
        /*return [
            'id'    => $id,
            'title' => $title,
        ];*/

        /*$message = 'The article successfully added';
        $container = new Container('add_product');
        $container->message = $message;*/

        $this->appSetCookie('addProduct', 'The article successfully added');

        return $this->redirect()->toRoute('article');
    }

    public function appSetCookie($cookieName, $message)
    {
        $cookie = new SetCookie($cookieName, $message, time() + 3600 * 24 * 100, '/');
        $this->getResponse()->getHeaders()->addHeader($cookie);
    }

    public function appGetCookie($cookieName)
    {
        $message = '';
        $cookie = $this->getRequest()->getCookie();
        if ($cookie && $cookie->offsetExists($cookieName)) {
            $message = $cookie->offsetGet($cookieName);

            $cookie = new SetCookie($cookieName, '', time() - 3600, '/');
            $this->getResponse()->getHeaders()->addHeader($cookie);

            return $message;
        }
    }
}
