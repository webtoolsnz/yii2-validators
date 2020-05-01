<?php

namespace webtoolsnz\validator\tests;

use webtoolsnz\validators\en_GB\PostCodeValidator;
use yii\codeception\TestCase;

/**
 * Class UkPostCodeValidatorTest
 * @package webtoolsnz\validator\tests
 */
class UkPostCodeValidatorTest extends \PHPUnit\Framework\TestCase
{
    public $appConfig = '@tests/config/unit.php';

    /**
     * @dataProvider postCodeProvider
     */
    public function testValidator($postCode, $expected)
    {
        $validator = new PostCodeValidator();
        $this->assertEquals($expected, $validator->validate($postCode));
    }

    /**
     * @return array
     */
    public function postCodeProvider()
    {
        return [
            ['', false],
            ['ABC123', false],
            ['V1 1AA', false],
            ['M6L 1NW', false],
            ['CJ2 6XH', false],
            ['W1L 1HQ', false],
            ['EC1A 1BC', false],
            ['GIR 1AA', false],
            ['5Ty6tty', false],
            ['3454545', false],
            ['BS45678TH', false],
            ['BF 3RT', false],
            ['AB12C 1AA', false],
            ['B12D 3XY', false],
            ['Q1 5AT', false],
            ['BI10 4UD', false],
            ['BS25 1NB', true],
            ['B5 5TF', true],
            ['SW1A 4RT', true],
            ['M1 1AA', true],
            ['M60 1NW', true],
            ['CR2 6XH', true],
            ['DN55 1PT', true],
            ['W1A 1HQ', true],
            ['EC1A 1BB', true],
            ['CF23 7JN', true],
            ['BS8 4UD', true],
            ['GU19 5AT', true],
            ['CF11 6TA', true],
            ['SW1A 1AA', true],
            ['NW9 0EQ', true],
        ];
    }
}


