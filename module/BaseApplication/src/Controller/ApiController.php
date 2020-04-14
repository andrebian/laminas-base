<?php

namespace BaseApplication\Controller;

use Laminas\Mvc\Controller\AbstractRestfulController;

/**
 * Class ApiController
 * @package BaseApplication\Controller
 * @codeCoverageIgnore
 */
class ApiController extends AbstractRestfulController
{
    /**
     * @return \Laminas\ServiceManager\ServiceLocatorInterface
     */
    protected function getServiceManager()
    {
        return $this->getEvent()->getApplication()->getServiceManager();
    }

    /**
     * @param $content
     */
    protected function renderJson($content)
    {
        $content = json_encode($content);
        header('Content-Type: application/json');
        print $content;
        exit;
    }

    protected function renderFail()
    {
        print 'fail';
        exit;
    }
}
