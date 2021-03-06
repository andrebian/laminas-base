<?php
/**
 * Created by PhpStorm.
 * User: andrebian
 * Date: 15/06/18
 * Time: 00:01
 */

namespace Test\User\Controller;

use User\Controller\Admin\UserController as AdminUserController;
use Laminas\Stdlib\ArrayUtils;
use Laminas\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

/**
 * Class AdminUserControllerTest
 * @package Test\User\Controller
 *
 * @group User
 * @group Controllers
 */
class AdminUserControllerTest extends AbstractHttpControllerTestCase
{
    protected function setUp(): void
    {
        // The module configuration should still be applicable for tests.
        // You can override configuration here with test case specific values,
        // such as sample view templates, path stacks, module_listener_options,
        // etc.
        $configOverrides = [];

        $this->setApplicationConfig(ArrayUtils::merge(
            include __DIR__ . '/../../../../config/application.config.php',
            $configOverrides
        ));

        require_once __DIR__ . '/../../../../config/constants.php';

        parent::setUp();

//        $serviceManager = $this->getApplicationServiceLocator();
//        $serviceManager->setAllowOverride(true);
//        $serviceManager->setService(EntityManager::class, $entityManager);
    }

    public function testIndexActionUnathenticated()
    {
        $this->dispatch('/admin/user/index', 'GET');
        $this->assertResponseStatusCode(302);
        $this->assertModuleName('User');
        $this->assertControllerName(AdminUserController::class);
        $this->assertMatchedRouteName('admin-user');
    }
}
