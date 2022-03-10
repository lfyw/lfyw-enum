<?php

namespace Lfyw\LfywEnum;

interface Enumable
{
    public static function getNames(): array;

    public static function getValues(): array;

    public static function getDescriptions(): array;

    public static function hasValue($value): bool;

    public static function hasName(string $key): bool;

    public static function getDescriptionByName($name): string;

    public static function getDescriptionByValue($value): string;

    public function getDescription(): string;

    public function getName();

    public function getValue();
}
