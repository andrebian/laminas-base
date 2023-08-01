<?php

namespace Test\BaseApplication\View\Helper;

use BaseApplication\View\Helper\JsonDecodeViewHelper;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * Class JsonDecodeViewHelperTest
 * @package Test\BaseApplication\View\Helper
 */
class JsonDecodeViewHelperTest extends TestCase
{
    /**
     * @test
     */
    public function invoke()
    {
        $jsonDecodeViewHelper = new JsonDecodeViewHelper();

        $jsonContent = '{"test": true, "pass": "ok"}';

        $this->assertInstanceOf(stdClass::class, $jsonDecodeViewHelper($jsonContent));
        $this->assertIsArray($jsonDecodeViewHelper($jsonContent, true));
    }
}
