<?php

namespace BaseApplication\Controller;

use Laminas\Mvc\Controller\AbstractActionController;

/**
 * Class BaseController
 * @package BaseApplication\Controller
 * @codeCoverageIgnore
 */
abstract class BaseController extends AbstractActionController
{
    /**
     * @return \Laminas\ServiceManager\ServiceLocatorInterface
     */
    protected function getServiceManager()
    {
        return $this->getEvent()->getApplication()->getServiceManager();
    }
}
