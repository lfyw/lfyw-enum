<?php

namespace Lfyw\LfywEnum;

interface Enumable
{
    public static function getNames():array;

    public static function getValues():array;

    public static function getDescriptions():array;

    public function getDescription():string;

    public function getName();

    public function getValue();

    public function hasValue($value):bool;

    public function hasName(string $key):bool;
}
