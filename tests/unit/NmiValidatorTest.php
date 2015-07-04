<?php

namespace webtoolsnz\validator\tests;

use webtoolsnz\validators\en_AU\NmiValidator;
use yii\codeception\TestCase;

class NmiValidatorTest extends TestCase
{
    public $appConfig = '@tests/config/unit.php';

    /**
     * @dataProvider nmiProvider
     */
    public function testValidator($nmi, $expected)
    {
        $validator = new NmiValidator();
        $this->assertEquals($expected, $validator->validate($nmi, $error));
    }

    public function nmiProvider()
    {
        return [
            ['11111111111', false],
            ['ABCDEFGLMNO', false],
            ['20019857328', true],
            ['20019857336', true],
            ['30756218758', true],
        ];
    }
}