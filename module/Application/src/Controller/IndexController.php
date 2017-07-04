<?php

namespace Application\Controller;

use Zend\Http\Response\Stream;
use Zend\Http\Headers;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    const DS = DIRECTORY_SEPARATOR;

    public function indexAction()
    {
        $url = $this->url()->fromRoute();
        return new ViewModel([
            'url' => $url,
            'date' => $this->getDate(),
        ]);
    }

    public function downloadAction()
    {
        $file = getcwd() . self::DS . 'public'
                         . self::DS . 'img'
                         . self::DS . 'c.jpg';

        if (is_file($file)) {
            $fileSize = filesize($file);

            $stream = new Stream();
            $stream->setStream(fopen($file, 'r'))
                   ->setStreamName(basename($file))
                   ->setStatusCode(200);

            $headers = new Headers();
            $headers->addHeaderLine('Content-Type: application/octet-stream')
                    ->addHeaderLine('Content-Disposition: attachment; filename = ' . basename($file))
                    ->addHeaderLine('Content-Length:' . $fileSize)
                    ->addHeaderLine('Cache-Control: no-store');

            $stream->setHeaders($headers);
            return $stream;
        }

        return false;
    }
}
