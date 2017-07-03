<?php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Tutorial\Service\GreetingServiceInterface;
use Zend\Session\Container;
use Zend\Http\Header\SetCookie;

class ArticleController extends AbstractActionController
{
    public function indexAction()
    {
        $message = '';

        /*$container = new Container('addArticle');
        $message = $container->message;
        $container->getManager()->getStorage()->clear('addArticle');*/

        /*$cookie = $this->getRequest()->getCookie();
        if ($cookie && $cookie->offsetExists('addArticle')) {
            $message = $cookie->offsetGet('addArticle');

            $cookie = new Setcookie('addArticle', '', time() - 3600, '/');
            $this->getResponse()->getHeaders()->addHeader($cookie);
        }*/

        $message = $this->appCookie()->getCookie('addArticle', $this);

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

        /*$container = new Container('addArticle');
        $container->message = 'Article successfully added';*/

        /*$cookie = new SetCookie('addArticle', 'Article successfully added', time() + 3600 * 24 * 100, '/');
        $this->getResponse()->getHeaders()->addHeader($cookie);*/

        $this->appCookie()->addCookie('addArticle', 'Article successfully added', $this);

        return $this->redirect()->toRoute('article');
    }


}
