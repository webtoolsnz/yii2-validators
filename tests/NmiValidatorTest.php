<?php

namespace webtoolsnz\validator\tests;

use webtoolsnz\validators\en_AU\NmiValidator;

/**
 * Class NmiValidatorTest
 * @package webtoolsnz\validator\tests
 */
class NmiValidatorTest extends \PHPUnit_Framework_TestCase
{
    public $appConfig = '@tests/config/unit.php';

    /**
     * @dataProvider nmiProvider
     */
    public function testValidator($nmi, $expected)
    {
        $validator = new NmiValidator();
        $this->assertEquals($expected, $validator->validate($nmi));
    }

    /**
     * @return array
     */
    public function nmiProvider()
    {
        return [
            ['', false],
            ['00000000000', false],
            ['11111111111', false],
            ['ABCDEFGLMNO', false],
            ['2001985732', false],
            ['QAAAVZZZZ4', false],
            ['QAAAVZZZZZ4', false],
            ['2001985733', false],
            ['QCDWW00010', false],
            ['3075621875', false],
            /**
             * Valid NMI's retrieved from 
             * http://www.aemo.com.au/Electricity/Policies-and-Procedures/Retail-and-Metering/National-Metering-Identifier-Procedure 
             */
            ['20019857328', true],
            ['QAAAVZZZZZ3', true],
            ['20019857336', true],
            ['QCDWW000102', true],
            ['30756218758', true],
            ['SMVEW000858', true],
            ['30756218766', true],
            ['VAAA0000657', true],
            ['43168540059', true],
            ['VAAA0000665', true],
            ['43168540067', true],
            ['VAAA0000672', true],
            ['63058884446', true],
            ['VAAASTY5768', true],
            ['63508884442', true],
            ['VCCCX000091', true],
            ['70018883338', true],
            ['VEEEX000091', true],
            ['71020000017', true],
            ['VKTS7861502', true],
            ['NAAAMYS5826', true],
            ['VKTS8671505', true],
            ['NBBBX111100', true],
            ['VKTS8716507', true],
            ['NBBBX111118', true],
            ['VKTS8761057', true],
            ['NCCC5194955', true],
            ['VKTS8761503', true],
            ['NGGG0000554', true],
            ['VKTS8765108', true],       
        ];
    }
}


