<?php

namespace Test\BaseApplication\View\Helper;

use BaseApplication\View\Helper\BrazilianStateHelperComboViewHelper;
use PHPUnit\Framework\TestCase;

/**
 * Class BrazilianStateHelperComboViewHelperTest
 * @package Test\BaseApplication\View\Helper
 */
class BrazilianStateHelperComboViewHelperTest extends TestCase
{
    /**
     * @test
     */
    public function invoke()
    {
        $viewHelper = new BrazilianStateHelperComboViewHelper();

        $viewHelperResult = $viewHelper();

        $this->assertStringContainsString('<option', $viewHelperResult);
        $this->assertStringContainsString('Paraná', $viewHelperResult);
    }
}
