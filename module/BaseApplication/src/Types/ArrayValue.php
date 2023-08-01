<?php

declare(strict_types=1);

namespace BaseApplication\Types;

/**
 * Class ArrayType
 * @package BaseApplication\Types
 */
class ArrayValue
{
    /**
     * @var array
     */
    private array $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return implode(', ', $this->data);
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->data);
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getKey(string $key)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }

        return null;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function append($key, $value): ArrayValue
    {
        $this->data[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     * @return $this
     */
    public function drop(string $key): ArrayValue
    {
        if (array_key_exists($key, $this->data)) {
            unset($this->data[$key]);
        }

        return $this;
    }
}
