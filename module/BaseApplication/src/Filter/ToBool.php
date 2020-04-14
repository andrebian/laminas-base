<?php

namespace BaseApplication\Filter;

use Laminas\Filter\AbstractFilter;
use Laminas\Filter\Exception;

/**
 * Class ToBool
 * @package BaseApplication\Filter
 */
class ToBool extends AbstractFilter
{
    /**
     * Returns the result of filtering $value
     *
     * @param mixed $value
     * @return mixed
     * @throws Exception\RuntimeException If filtering $value is impossible
     */
    public function filter($value)
    {
        return (bool)$value;
    }
}
