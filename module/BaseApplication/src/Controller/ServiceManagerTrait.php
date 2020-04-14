<?php

namespace BaseApplication\Controller;

/**
 * Trait ServiceManagerTrait
 * @package BaseApplication\Controller
 */
trait ServiceManagerTrait
{
    /**
     * @return \Laminas\ServiceManager\ServiceLocatorInterface
     */
    protected function getServiceManager()
    {
        return $this->getEvent()->getApplication()->getServiceManager();
    }
}
