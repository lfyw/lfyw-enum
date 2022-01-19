<?php

namespace Lfyw\LfywEnum;

trait HasEnum
{
    public static function getNames():array
    {
        return array_column(static::cases(), 'name');
    }

    public static function getValues():array
    {
        return array_column(static::cases(), 'value');
    }

    public static function getDescriptions():array
    {
        return array_combine(static::getNames(), static::getValues());
    }

    public static function hasValue($value, bool $strict = false):bool
    {
        $values = static::getValues();

        return $strict ? in_array($value, $values, $strict) : in_array((string) $value, array_map('strval', $values), true);
    }

    public static function hasName(string $key):bool
    {
        return in_array($key, static::getNames(), true);
    }

    public function getDescription():string|int
    {
        $descriptions = static::getDescriptions();
        return $descriptions[$this->name];
    }

    public function getName():string|int
    {
        return $this->name;
    }

    public function getValue():string|int
    {
        return $this->value;
    }
}
