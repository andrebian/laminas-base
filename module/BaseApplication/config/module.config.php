<?php

namespace BaseApplication;

use BaseApplication\Controller\AdminIndexController;
use BaseApplication\Controller\IndexController;
use BaseApplication\Controller\SearchController;
use BaseApplication\Mail\Mail;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Exception;
use Laminas\Mail\Transport\Smtp;
use Laminas\Mail\Transport\SmtpOptions;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\View\Renderer\PhpRenderer;
use Psr\Container\ContainerInterface;

$ormCacheEngine = 'array';
if (defined('ORM_CACHE_ENGINE')) {
    $ormCacheEngine = ORM_CACHE_ENGINE;
}

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'public' => true,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'admin' => [
                'type' => Literal::class,
                'public' => false,
                'options' => [
                    'route' => '/admin',
                    'defaults' => [
                        'controller' => AdminIndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'default' => [
                'public' => true,
                'type' => Segment::class,
                'options' => [
                    'route' => '/index/:action[/:id]',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'search' => [
                'public' => true,
                'type' => Literal::class,
                'options' => [
                    'route' => '/search',
                    'defaults' => [
                        'controller' => SearchController::class,
                        'action' => 'index',
                    ],
                ],
            ]
        ],
    ],
    'controllers' => [
        'invokables' => [
            IndexController::class => IndexController::class,
            SearchController::class => SearchController::class,
            AdminIndexController::class => AdminIndexController::class
        ]
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'layout/ajax' => __DIR__ . '/../view/layout/ajax.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
            'flash-messages' => __DIR__ . '/../view/partials/flash-messages.phtml',
            'admin/pagination' => __DIR__ . '/../view/partials/admin/pagination.phtml'
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'translator' => [
        'locale' => 'pt_BR',
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ],
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => $ormCacheEngine,
                'paths' => [dirname(__DIR__) . '/src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],
    'service_manager' => [
        'factories' => [
            Mail::class => function(ContainerInterface $container) {
                $smtpConfig = $container->get('config')['email'];
                $options = new SmtpOptions($smtpConfig);
                $transport = new Smtp($options);

                try {
                    $renderer = $container->get('ViewRenderer');
                } catch (Exception $e) {
                    $renderer = new PhpRenderer();
                }

                return new Mail($transport, $smtpConfig, $renderer,  '');
            }
        ]
    ]
];
