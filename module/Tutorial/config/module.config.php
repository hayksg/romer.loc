<?php

namespace Tutorial;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\Router\Http\Regex;
use Zend\Router\Http\Method;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'tutorial' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/tutorial',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'sample' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/sample',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'sample',
                    ],
                ],
            ],
            /*'article' => [
                'type' => Regex::class,
                'options' => [
                    'regex' => '/article(/(?<action>[a-z]*)/(?<id>[0-9]+))?',
                    'spec' => '/%action%/%id%',
                    'defaults' => [
                        'controller' => Controller\ArticleController::class,
                        'action'     => 'index',
                    ],
                ],
            ],*/
            /*'article' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/article[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-z]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\ArticleController::class,
                        'action'     => 'index',
                    ],
                ],
            ],*/
            'article' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/article',
                    'defaults' => [
                        'controller' => Controller\ArticleController::class,
                        'action'     => 'index',
                        //'action'     => rand(0, 1) ? 'post-add' : 'add',
                    ],
                ],
                'may_terminate' => true,
            ],
            'articleAction' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/article/add[/:id]',
                    'constraints' => [
                        'id'     => '[0-9]+',
                    ],
                ],
                'child_routes' => [
                    'get' => [
                        'type' => Method::class,
                        'options' => [
                            'verb' => 'get',
                            'defaults' => [
                                'controller' => Controller\ArticleController::class,
                                'action'     => 'add',
                            ],
                        ],
                    ],
                    'post' => [
                        'type' => Method::class,
                        'options' => [
                            'verb' => 'post',
                            'defaults' => [
                                'controller' => Controller\ArticleController::class,
                                'action'     => 'post-add',
                            ],
                        ],
                    ],
                ],
            ],
            /*'product' => [
                'type' => Regex::class,
                'options' => [
                    'regex'  => '/product(/(?<action>[a-z]*)/(?<id>[0-9]+))?',
                    'spec'   => '/%action%/%id%',
                    'defaults' => [
                        'controller' => Controller\ProductController::class,
                        'action'     => 'index',
                    ],
                ],
            ],*/
            'product' => [
                'type' => Segment::class,
                'options' => [
                    'route'  => '/product',
                    'defaults' => [
                        'controller' => Controller\ProductController::class,
                        'action'     => 'index',
                        //'action'     => rand(0, 1) ? 'add' : 'post-add',
                    ],
                ],
            ],
            'productAdd' => [
                'type' => Segment::class,
                'options' => [
                    'route'  => '/product/add[/:id]',
                    'constraints'  => [
                        'id' => '[0-9]+',
                    ],
                ],
                'child_routes' => [
                    'getAdd' => [
                        'type' => Method::class,
                        'options' => [
                            'verb'  => 'get',
                            'defaults' => [
                                'controller' => Controller\ProductController::class,
                                'action'     => 'add',
                            ],
                        ],
                    ],
                    'postAdd' => [
                        'type' => Method::class,
                        'options' => [
                            'verb'  => 'post',
                            'defaults' => [
                                'controller' => Controller\ProductController::class,
                                'action'     => 'post-add',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\ArticleController::class => InvokableFactory::class,
            Controller\ProductController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'tutorial/index/index' => __DIR__ . '/../view/tutorial/index/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
