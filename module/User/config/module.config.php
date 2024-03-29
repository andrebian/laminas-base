<?php

namespace User;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use User\Controller\Admin\AuthController as AdminAuthController;
use User\Controller\Admin\PasswordRecoveryController as AdminPasswordRecoveryController;
use User\Controller\Admin\UserController as AdminUserController;
use User\Controller\AuthController;
use User\Controller\PasswordRecoveryController;
use Laminas\I18n\Translator\TranslatorServiceFactory;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;

$ormCacheEngine = 'array';
if (defined('ORM_CACHE_ENGINE')) {
    $ormCacheEngine = ORM_CACHE_ENGINE;
}

return [
    'router' => [
        'routes' => [
            'admin-login' => [
                'type' => Literal::class,
                'public' => true,
                'options' => [
                    'route' => '/admin/login',
                    'defaults' => [
                        'controller' => AdminAuthController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'admin-logout' => [
                'type' => Literal::class,
                'public' => true,
                'options' => [
                    'route' => '/admin/logout',
                    'defaults' => [
                        'controller' => AdminAuthController::class,
                        'action' => 'logout',
                    ],
                ],
            ],
            'admin-user' => [
                'type' => Segment::class,
                'public' => false,
                'options' => [
                    'route' => '/admin/user/:action[/:id]',
                    'defaults' => [
                        'controller' => AdminUserController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'admin-password-recovery' => [
                'type' => Literal::class,
                'public' => true,
                'options' => [
                    'route' => '/admin/user/password-recovery',
                    'defaults' => [
                        'controller' => AdminPasswordRecoveryController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'admin-recovery-password-action' => [
                'type' => Literal::class,
                'public' => true,
                'options' => [
                    'route' => '/admin/user/recovery-password-action',
                    'defaults' => [
                        'controller' => AdminPasswordRecoveryController::class,
                        'action' => 'recoverPassword',
                    ],
                ],
            ],
            'admin-password-recovery-error' => [
                'type' => Literal::class,
                'public' => true,
                'options' => [
                    'route' => '/admin/user/password-recovery-error',
                    'defaults' => [
                        'controller' => AdminPasswordRecoveryController::class,
                        'action' => 'error',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            AuthController::class => AuthController::class,
            PasswordRecoveryController::class => PasswordRecoveryController::class,
            AdminAuthController::class => AdminAuthController::class,
            AdminPasswordRecoveryController::class => AdminPasswordRecoveryController::class,
            AdminUserController::class => AdminUserController::class
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'template_path_stack' => [
            __DIR__ . '/../view',
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
        ],
        'fixture' => [
            __NAMESPACE__ => __DIR__ . '/../src/Fixture'
        ]
    ],
    'service_manager' => [
        'abstract_factories' => [
            'Laminas\Cache\Service\StorageCacheAbstractServiceFactory',
            'Laminas\Log\LoggerAbstractServiceFactory',
        ],
        'factories' => [
            'translator' => TranslatorServiceFactory::class
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
];
