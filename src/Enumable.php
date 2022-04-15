<?php

namespace Lfyw\LfywEnum;

interface Enumable
{
    public static function getNames(): array;

    public static function getValues(): array;

    public static function getDescriptions(): array;

    public static function hasValue(mixed $value): bool;

    public static function hasName(string|null $key): bool;

    public static function getDescriptionByName(string|null $name): string;

    public static function getDescriptionByValue(mixed $value): string;

    public static function getValueByName(): string|null;

    public function getDescription(): string;

    public function getName(): string|int;

    public function getValue(): mixed;
}
