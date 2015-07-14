<?php

namespace webtoolsnz\validator\tests;

use webtoolsnz\validators\PasswordStrengthValidator;
use yii\codeception\TestCase;

/**
 * Class UkPostCodeValidatorTest
 * @package webtoolsnz\validator\tests
 */
class PasswordStrengthValidatorTest extends \PHPUnit_Framework_TestCase
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
        $this->assertEquals(true, $validator->validate('ab'));
        $this->assertEquals(false, $validator->validate('a'));
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
        $this->assertEquals(true, $validator->validate('ab'));
        $this->assertEquals(false, $validator->validate('a'));
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
        $this->assertEquals(true, $validator->validate('ABC'));
        $this->assertEquals(false, $validator->validate('A'));
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
        $this->assertEquals(true, $validator->validate('12'));
        $this->assertEquals(false, $validator->validate('a'));
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
        $this->assertEquals(true, $validator->validate('*(&@#^%'));
        $this->assertEquals(false, $validator->validate('a'));
    }
    public function testDefaultRules()
    {
        $validator = new PasswordStrengthValidator();
        $this->assertEquals(true, $validator->validate('MySecureP4ssW@rd'));
        $this->assertEquals(false, $validator->validate('abcd'));
        $this->assertEquals(false, $validator->validate('password1'));
        $this->assertEquals(false, $validator->validate('Password1'));
    }
}


