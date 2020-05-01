<?php

namespace webtoolsnz\validator\tests;

use webtoolsnz\validators\PasswordStrengthValidator;
use yii\codeception\TestCase;

/**
 * Class UkPostCodeValidatorTest
 * @package webtoolsnz\validator\tests
 */
class PasswordStrengthValidatorTest extends \PHPUnit\Framework\TestCase
{
    public $appConfig = '@tests/config/unit.php';

    public function testLength()
    {
        $validator = new PasswordStrengthValidator([
            'minimum_length' => 2,
            'minimum_lower' => 0,
            'minimum_upper' => 0,
            'minimum_digit' => 0,
            'minimum_special' => 0,
            ]);
        $this->assertTrue($validator->validate('ab'));
        $this->assertFalse($validator->validate('a'));
    }
    public function testLower()
    {
        $validator = new PasswordStrengthValidator([
            'minimum_length' => 0,
            'minimum_lower' => 2,
            'minimum_upper' => 0,
            'minimum_digit' => 0,
            'minimum_special' => 0,
            ]);
        $this->assertTrue($validator->validate('ab'));
        $this->assertFalse($validator->validate('a'));
    }
    public function testUpper()
    {
        $validator = new PasswordStrengthValidator([
            'minimum_length' => 0,
            'minimum_lower' => 0,
            'minimum_upper' => 2,
            'minimum_digit' => 0,
            'minimum_special' => 0,
            ]);
        $this->assertTrue($validator->validate('ABC'));
        $this->assertFalse($validator->validate('A'));
    }
    public function testDigit()
    {
        $validator = new PasswordStrengthValidator([
            'minimum_length' => 0,
            'minimum_lower' => 0,
            'minimum_upper' => 0,
            'minimum_digit' => 2,
            'minimum_special' => 0,
            ]);
        $this->assertTrue($validator->validate('12'));
        $this->assertFalse($validator->validate('a'));
    }
    public function testSpecial()
    {
        $validator = new PasswordStrengthValidator([
            'minimum_length' => 0,
            'minimum_lower' => 0,
            'minimum_upper' => 0,
            'minimum_digit' => 0,
            'minimum_special' => 6,
            ]);
        $this->assertTrue($validator->validate('*(&@#^%'));
        $this->assertFalse($validator->validate('a'));
    }
    public function testDefaultRules()
    {
        $validator = new PasswordStrengthValidator();
        $this->assertTrue($validator->validate('MySecureP4ssW@rd'));
        $this->assertFalse($validator->validate('abcd'));
        $this->assertFalse($validator->validate('password1'));
        $this->assertFalse($validator->validate('Password1'));
    }
}


