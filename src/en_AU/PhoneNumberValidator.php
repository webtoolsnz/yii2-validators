<?php

namespace webtoolsnz\validators\en_AU;


class PhoneNumberValidator extends \webtoolsnz\validators\PhoneNumberValidator
{
    public $expectedRegion = 'AU';
    public $available_prefixes = [
        '02',
        '03',
        '04',
        '05', // Unused; formerly Location Independent Communication Services, to be assigned as a second mobile code in 2017
              // https://en.wikipedia.org/wiki/Telephone_numbers_in_Australia#cite_ref-05-numbers_8-0
        '07',
        '08',
    ];
}
