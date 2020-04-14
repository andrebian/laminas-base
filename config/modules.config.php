<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

/**
 * List of enabled modules for this application.
 *
 * This should be an array of module namespaces used in the application.
 */

$modules = [
    'Laminas\I18n',
    'Laminas\InputFilter',
    'Laminas\Filter',
    'Laminas\Hydrator',
    'Laminas\Mail',
    'Laminas\Cache',
    'Laminas\Paginator',
    'Laminas\ServiceManager\Di',
    'Laminas\Session',
    'Laminas\Mvc\Plugin\Prg',
    'Laminas\Mvc\Plugin\Identity',
    'Laminas\Mvc\Plugin\FlashMessenger',
    'Laminas\Mvc\Plugin\FilePrg',
    'Laminas\Mvc\I18n',
    'Laminas\Mvc\Console',
    'Laminas\Log',
    'Laminas\Form',
    'Laminas\Db',
    'Laminas\Router',
    'Laminas\Validator',
    'Laminas\ZendFrameworkBridge'
    'DoctrineModule',
    'DoctrineORMModule',
    'SendGridTransportModule',
    'BaseApplication',
    'User'
];

return $modules;
