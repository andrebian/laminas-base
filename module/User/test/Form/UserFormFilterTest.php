<?php

namespace User\Form;

use Exception;
use PHPUnit\Framework\TestCase;
use Laminas\InputFilter\BaseInputFilter;

/**
 * Class UserFormFilterTest
 * @package User\Form
 *
 * @group User
 * @group Form
 */
class UserFormFilterTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->className = UserFormFilter::class;
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function checkIfClassExist()
    {
        $this->assertTrue(class_exists($this->className));
    }

    /**
     * @test
     * @expectedException Exception
     */
    public function checkSetInputFilter()
    {
        $this->expectException(Exception::class);

        $formFilter = new $this->className();

        $filterInterface = new BaseInputFilter();
        $formFilter->setInputFilter($filterInterface);
    }

    /**
     * @test
     */
    public function checkGetInputFilter()
    {
        $formFilter = new $this->className();
        $result = $formFilter->getInputFilter();

        $this->assertNotNull($result);
        $this->assertArrayHasKey('name', $result->getInputs());
        $this->assertArrayHasKey('username', $result->getInputs());
        $this->assertArrayHasKey('password', $result->getInputs());
        $this->assertArrayHasKey('avatar', $result->getInputs());
    }
}
