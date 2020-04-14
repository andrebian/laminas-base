<?php

namespace BaseApplication\Filter;

use Laminas\Filter\FilterInterface;

/**
 * Class ExtractNumbers
 * @package BaseApplication\Filter
 */
class ExtractNumbers implements FilterInterface
{
    /**
     * @inheritdoc
     */
    public function filter($value)
    {
        return preg_replace("/\D/", '', $value);
    }
}
