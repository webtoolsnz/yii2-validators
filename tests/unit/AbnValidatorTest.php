<?php

namespace webtoolsnz\validator\tests;

use webtoolsnz\validators\en_AU\AbnValidator;
use yii\codeception\TestCase;

/**
 * Class AbnValidatorTest
 * @package webtoolsnz\validator\tests
 */
class AbnValidatorTest extends TestCase
{
    public $appConfig = '@tests/config/unit.php';

    /**
     * @dataProvider abnProvider
     */
    public function testValidator($abn, $expected)
    {
        $validator = new AbnValidator();
        $this->assertEquals($expected, $validator->validate($abn));
    }

    /**
     * @return array
     */
    public function abnProvider()
    {
        return [
            ['', false],
            ['ABN000215422', false],
            ['00130539123', false],
            ['5642354625523', false],
            ['28 043 145 470', true],
            ['65 497 794 289', true],
            ['46 527 394 509', true],
            ['99 070 045 359', true],
            ['98 860 905 153', true],
            ['53 106 288 699', true],
            ['51 008 129 511', true],
            ['43 500 713 236', true],
            ['72 342 387 170', true],
            ['21 188 299 895', true],
            ['55 914 901 347', true],
            ['92 638 328 368', true],
            ['98983846645', true],
            ['48123123124', true],
            ['96 160 362 792', true],
            ['95942373762', true],
            ['63007751359', true],
            ['54286993290', true],
            ['37786812467', true],
            ['15 007 316 930', true],
            ['36 141 446 102', true],
            ['99095663273', true],
            ['15007316930', true],
            ['16007039536', true],
            ['14 004 349 517', true],
            ['47168191633', true],
            ['73315925068', true],
            ['17 023 608 663', true],
            ['56789496568', true],
        ];
    }
}


