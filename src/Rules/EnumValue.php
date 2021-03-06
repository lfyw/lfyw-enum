<?php

namespace Lfyw\LfywEnum\Rules;

use Illuminate\Contracts\Validation\Rule;

class EnumValue implements Rule
{
    protected string $rule = 'enum_value';

    public function __construct(
        protected $enumClass,
        protected $strict = false,
    ) {
        throw_unless(class_exists($this->enumClass), new \InvalidArgumentException("枚举类 {$this->enumClass} 不存在."));
    }

    /**
     * 判断是否通过验证规则。
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->enumClass::hasValue($value, $this->strict);
    }

    /**
     * 获取校验错误信息。
     *
     * @return string
     */
    public function message()
    {
        return ':attribute 枚举值不在范围内.';
    }

    public function __toString()
    {
        return "{$this->rule}:{$this->enumClass}";
    }
}
