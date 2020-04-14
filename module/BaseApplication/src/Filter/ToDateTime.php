<?php

namespace BaseApplication\Filter;

use DateTime;
use Laminas\Filter\AbstractFilter;
use Laminas\Filter\Exception;

/**
 * Class ToDateTime
 * @package BaseApplication\Filter
 */
class ToDateTime extends AbstractFilter
{
    /**
     * Returns the result of filtering $value
     *
     * @param  mixed $value
     * @return mixed
     * @throws Exception\RuntimeException If filtering $value is impossible
     * @throws \Exception
     */
    public function filter($value)
    {
        return new DateTime(str_replace('/', '-', $value));
    }
}
