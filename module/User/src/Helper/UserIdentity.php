<?php

namespace User\Helper;

use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Storage\Session as SessionStorage;

/**
 * Class UserIdentity
 * @package User\Helper
 */
class UserIdentity
{
    /**
     * @param $namespace
     * @return bool|mixed|null
     */
    public function getIdentity($namespace)
    {
        $response = false;

        $sessionStorage = new SessionStorage($namespace);
        $authService = new AuthenticationService();

        $authService->setStorage($sessionStorage);

        if ($authService->hasIdentity()) {
            $response = $authService->getIdentity();
        }

        return $response;
    }

    /**
     * @param $namespace
     * @return bool
     */
    public function hasIdentity($namespace)
    {
        $sessionStorage = new SessionStorage($namespace);
        $authService = new AuthenticationService();

        $authService->setStorage($sessionStorage);

        return $authService->hasIdentity();
    }
}
