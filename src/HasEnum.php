<?php

namespace Lfyw\LfywEnum;

use Lfyw\LfywEnum\Exceptions\InvalidEnumTypeException;
use Lfyw\LfywEnum\Exceptions\NullDescriptionException;

trait HasEnum
{
    public static function getNames(): array
    {
        return array_column(static::cases(), 'name');
    }

    public static function getValues(): array
    {
        return array_column(static::cases(), 'value');
    }

    public static function getDescriptions(): array
    {
        return static::isBacked() ? array_combine(static::getNames(), static::getValues()) : [];
    }

    public static function hasValue($value, bool $strict = false): bool
    {
        $values = static::getValues();

        return $strict ? in_array($value, $values, $strict) : in_array((string) $value, array_map('strval', $values), true);
    }

    public static function hasName(string $key): bool
    {
        return in_array($key, static::getNames(), true);
    }

    public static function getDescriptionByValue($value): string
    {
        return static::isBacked() ? (static::tryFrom($value)?->getDescription() ?: '') : '';
    }

    public static function getDescriptionByName(string $name): string
    {
        return static::getDescriptions()[$name] ?? '';
    }

    public static function getValueByName(string $name)
    {
        if (!static::isBacked()){
            return null;
        }

        $array = [];
        $cases = static::cases();
        foreach ($cases as $case){
            $array[$case->name] = $case->value;
        }
        return $array[$name] ?? '';
    }

    public function getDescription(): string
    {
        return  static::getDescriptions()[$this->name] ?? '';
    }

    public function getName(): string|int
    {
        return $this->name;
    }

    public function getValue()
    {
        return static::getValues() ? $this->value : null;
    }

    private static function isBacked():bool
    {
        return (bool)static::getValues();
    }

    /**
     * Handle dynamic static method calls into the model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return static::hasName($method) ? static ::getValueByName($method) : null;
    }
}
