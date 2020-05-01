<?php

namespace webtoolsnz\validator\tests;

use webtoolsnz\validators\PhoneNumberValidator;
use yii\base\DynamicModel;
use yii\codeception\TestCase;

/**
 * Class PhoneNumberValidatorTest
 * @package webtoolsnz\validator\tests
 */
class PhoneNumberValidatorTest extends \PHPUnit\Framework\TestCase
{
    public $appConfig = '@tests/config/unit.php';

    public function testNoRegion()
    {
        $validator = new PhoneNumberValidator();
        $this->assertFalse($validator->validate('021 700 700'));
        $this->assertTrue($validator->validate('+64 21 700 700'));
    }
    public function testRegionHint()
    {
        $validator = new PhoneNumberValidator([
            'expectedRegion' => 'NZ'
            ]);
        $this->assertTrue($validator->validate('021 700 700'));
        $this->assertTrue($validator->validate('+64 21 700 700'));
    }
    public function testRegionRequired()
    {
        $validator = new PhoneNumberValidator([
            'requiredRegion' => 'NZ',
        ]);
        $this->assertTrue($validator->validate('021 700 700'));
        $this->assertTrue($validator->validate('+64 21 700 700'));
        $this->assertFalse($validator->validate('+61 21 700 700'));
        $this->assertFalse($validator->validate('+61 414 121 121'));
    }
    public function testInvalidCountryCode()
    {
        $validator = new PhoneNumberValidator([]);
        $validator->validate('+0001', $error);
        $this->assertEquals($validator->message_invalid_country, $error);
        $validator->validate('+801 18243023', $error);
        $this->assertEquals($validator->message_invalid_country, $error);
    }
    public function testVariousInvalid()
    {
        $validator = new PhoneNumberValidator([]);
        $this->assertFalse($validator->validate(''));
        $this->assertFalse($validator->validate('a'));
        $this->assertFalse($validator->validate('afsfjlaskjfas'));
        $this->assertFalse($validator->validate('1'));
        $this->assertFalse($validator->validate('1421341234123413413847120389471'));
    }
    public function testNumberType()
    {
        $validator = new PhoneNumberValidator([
            'numberType' => PhoneNumberValidator::NUMBER_TYPE_MOBILE,
            'expectedRegion' => 'NZ'
            ]);
        $this->assertFalse($validator->validate('04 978 0738'));
        $this->assertTrue($validator->validate('021 700 700'));

        $validator = new PhoneNumberValidator([
            'numberType' => PhoneNumberValidator::NUMBER_TYPE_FIXED_LINE,
            'expectedRegion' => 'NZ'
            ]);
        $this->assertTrue($validator->validate('04 978 0738'));
        $this->assertFalse($validator->validate('021 700 700'));
    }
    public function testFormatting()
    {
        $model = DynamicModel::validateData(
            ['phone' => '04 978 0738'],
            [
                [
                    'phone', PhoneNumberValidator::className(),
                    'expectedRegion' => 'NZ',
                    'format' => PhoneNumberValidator::FORMAT_NATIONAL
                ],
            ]
        );
        $this->assertEquals('04-978 0738', $model->phone);
        $model = DynamicModel::validateData(
            ['phone' => '04 978 0738'],
            [
                [
                    'phone', PhoneNumberValidator::className(),
                    'expectedRegion' => 'NZ',
                    'format' => PhoneNumberValidator::FORMAT_INTERNATIONAL
                ],
            ]
        );
        $this->assertEquals('+64 4-978 0738', $model->phone);
        $model = DynamicModel::validateData(
            ['phone' => '04 978 0738'],
            [
                [
                    'phone', PhoneNumberValidator::className(),
                    'expectedRegion' => 'NZ',
                    'format' => PhoneNumberValidator::FORMAT_E164
                ],
            ]
        );
        $this->assertEquals('+6449780738', $model->phone);
    }
}


