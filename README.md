<h1 align="center"> lfyw-enum </h1>

<p align="center"> A php8.1 enum helper..</p>

![StyleCI build status](https://github.styleci.io/repos/449704539/shield) 

## Installing

```shell
$ composer require lfyw/lfyw-enum -vvv
```

## Usage

### 创建枚举类

枚举类会创建在 app/Enums 目录下

```shell
$ php artisan make:enum UserType
```

生成文件内容如下，可以在其中继续添加枚举值:

```php
<?php

namespace App\Enums;

use Lfyw\LfywEnum\Enumable;
use Lfyw\LfywEnum\HasEnum;

enum UserType:string implements Enumable
{
    use HasEnum;

    //以下为添加的示例内容
    case ADMIN = 'admin';
    case CONSUMER = 'consumer';
}
```

### 使用方法

#### UserType::getValues()

获取所有枚举值，如果不是一个回退枚举回返回一个空数组

#### UserType::getNames()

获取所有枚举名

#### UserType::getDescriptions()

获取所有注释。

* 默认必须是一个回退枚举，否则会抛出一个异常
* 可以在枚举中覆盖这个方法，以覆盖默认的注释。如果不是一个回退枚举，可以使用覆盖的方式创建注释，使用时不会再抛出异常
```php
<?php

namespace App\Enums;

use Lfyw\LfywEnum\Enumable;
use Lfyw\LfywEnum\HasEnum;

enum UserType:string implements Enumable
{
    use HasEnum;

    //以下为添加的示例内容
    case ADMIN = 'admin';
    case CONSUMER = 'consumer';

    public static function getDescriptions():array
    {
        return [
            UserType::Admin->name => 'super admin',
            UserType::Consumer->name => 'super consumer'
        ];
    }
}
```
#### UserType::getDescriptionByValue($value):string

根据值获取注释


#### UserType::getDescriptionByName(string $name):string

根据名称获取注释

#### UserType::USER()

调用`UserType::User->value`,如果不是回退枚举返回`null`

#### UserType::hasValue($value, bool $strict = false)

 检查枚举中是否包含某个值。

#### UserType::ADMIN->getDescription()

获取注释。如果不是回退枚举且没有覆盖默认的`getDescriptions()`方法会抛出一个异常。

#### UserType::ADMIN->getName()

获取名称

#### UserType::ADMIN->getValue()

获取值。必须是一个回退枚举，否则会抛出一个异常。

### 表单验证

```php
public function rules()
{
    return [
        'value' => [new EnumValue(Status::class, false)],
        'name' => [new EnumName(Status::class)],
    ];
}

```

## License

MIT