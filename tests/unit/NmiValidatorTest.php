<?php

namespace webtoolsnz\validator\tests;

use webtoolsnz\validators\en_AU\NmiValidator;
use yii\codeception\TestCase;

/**
 * Class NmiValidatorTest
 * @package webtoolsnz\validator\tests
 */
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
            ['20019857328', true],
            ['20019857336', true],
            ['30756218758', true],
            ['30756218766', true],
            ['43168540059', true],
            ['QAAAVZZZZZ3', true],
            ['QCDWW000102', true],
            ['SMVEW000858', true],
            ['VAAA0000657', true],
            ['62030037679', true],
            ['62030054510', true],
            ['62035170089', true],
            ['62035169188', true],
            ['62033110723', true],
            ['62035170139', true],
            ['62035168833', true],
            ['60013221479', true],
            ['61030178072', true],
            ['61030178065', true],
            ['61030178080', true],
            ['20021394343', true],
            ['63058998404', true],
            ['64076831148', true],
            ['20017300423', true],
            ['20021853316', true],
            ['20021636191', true],
            ['20010119914', true],
            ['20016859055', true],
            ['20017264238', true],
            ['20017144319', true],
            ['20016173557', true],
            ['20017790630', true],
            ['20016173549', true],
            ['20017790616', true],
            ['20017790622', true],
            ['20017790608', true],
            ['64077335072', true],
            ['64075307692', true],
            ['64075468238', true],
            ['64075307702', true],
            ['64075307684', true],
            ['64076963502', true],
            ['64072072366', true],
            ['61020105797', true],
            ['61020360053', true],
            ['61025325454', true],
            ['61023254564', true],
            ['61025327698', true],
            ['61020360094', true],
            ['61020381751', true],
            ['61020105748', true],
            ['61020105649', true],
            ['61021919368', true],
            ['64071935183', true],
            ['61027588316', true],
            ['61020652714', true],
            ['62030042200', true],
            ['62035052888', true],
            ['62035057937', true],
            ['62035057929', true],
            ['NCCC0070699', true],
            ['41036256244', true],
            ['41029059953', true],
            ['61030275356', true],
            ['61030219494', true],
            ['61030219504', true],
            ['61026714104', true],
            ['61020372064', true],
            ['43108871614', true],
            ['43103264688', true],
            ['43103392812', true],
            ['62036280141', true],
            ['62037858125', true],
            ['41032335464', true],
            ['41030134274', true],
            ['20010032239', true],
            ['61024415298', true],
            ['64077027110', true],
            ['64074541244', true],
            ['64073239680', true],
            ['63055589966', true],
            ['64080882895', true],
            ['61020446230', true],
            ['64074226323', true],
            ['64077630283', true],
            ['64074898139', true],
            ['64077849916', true],
            ['64071041273', true],
            ['64077089812', true],
            ['64078012234', true],
            ['63051720618', true],
            ['64077761772', true],
            ['64077818085', true],
            ['64077793601', true],
            ['64077773734', true],
            ['63058887077', true],
            ['64074014473', true],
            ['64073895211', true],
            ['64074094631', true],
            ['64077793591', true],
            ['64074967315', true],
            ['64076945623', true],
            ['64076945665', true],
            ['64078088233', true],
            ['63051771734', true],
            ['64077068039', true],
        ];
    }
}


