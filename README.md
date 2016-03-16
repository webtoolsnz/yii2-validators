# Yii2 Validators

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/webtoolsnz/yii2-validators/master.svg?style=flat-square)](https://travis-ci.org/webtoolsnz/yii2-validators)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/webtoolsnz/yii2-validators.svg?style=flat-square)](https://scrutinizer-ci.com/g/webtoolsnz/yii2-validators/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/webtoolsnz/yii2-validators.svg?style=flat-square)](https://scrutinizer-ci.com/g/webtoolsnz/yii2-validators)

A collection of Yii2 validators for various localities.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```bash
$ composer require webtoolsnz/yii2-validators
```

## Example Use

### Model Validation rules
```
use webtoolsnz\validators\en_AU\NmiValidator;

class MyModel extends \yii\base\Model
{
    public function rules()
    {
        return [
            [['nmi'], NmiValidator::className()]
        ];
    }
}

```

### Adhoc Validation
```
$validator = new webtoolsnz\validators\en_AU\NmiValidator();
$validator->validate('NGGG0000554');
```

## Available Validators
* PasswordStrengthValidator
* PhoneNumberValidator

### en_AU
* NmiValidator
* AbnValidator
* PhoneNumberValidator

### en_GB
* PostCodeValidator
* PhoneNumberValidator


### Phone Number Validation

Use `webtoolsnz\validators\en_GB\PhoneNumberValidator` or `webtoolsnz\validators\en_AU\PhoneNumberValidator` for simpilicity (no options required) for other regions use `webtoolsnz\validators\PhoneNumberValidator`

Options defined as follows
```php
$rules = [
   [
       'phone',
       webtoolsnz\validators\PhoneNumberValidator::className(),
            // ISO 2 letter country code - Required (unless using en_GB or en_AU versions) will convert
            // 021 => +6421
        'expectedRegion' => 'NZ',

            // auto fills expectedRegion - phone number MUST be from this region
        'requiredRegion' => 'NZ',

            // number is required to match type, NUMBER_TYPE_FIXED_LINE is also available
        'numberType' => PhoneNumberValidator::NUMBER_TYPE_MOBILE,

            // will re-format input to match the given format. Values are FORMAT_NATIONAL FORMAT_E164 and FORMAT_INTERNATIONAL
        'format' => PhoneNumberValidator::FORMAT_E164,


        // some error messages are also customizable
];
```


## Testing

`webtoolsnz/` has a [PHPUnit](https://phpunit.de) test suite. To run the tests, run the following command from the project folder.

``` bash
$ composer test
```

## License

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.