<?php

namespace BaseApplication\Filter;

use Laminas\Filter\AbstractFilter;
use Laminas\Filter\Exception;

/**
 * Class CurrencyToFloat
 * @package BaseApplication\Filter
 */
class CurrencyToFloat extends AbstractFilter
{
    /**
     * Returns the result of filtering $value
     *
     * @param  mixed $value
     * @throws Exception\RuntimeException If filtering $value is impossible
     * @return mixed
     */
    public function filter($value)
    {
        if (! is_scalar($value)) {
            return $value;
        }
        $value = (string)$value;
        $value = str_replace(['R$', ' '], '', $value);
        $value = str_replace(['.', ','], ['', '.'], $value);

        return (float)$value;
    }
}
