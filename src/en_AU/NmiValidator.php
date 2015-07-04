<?php
namespace webtoolsnz\validators\en_AU;

use Yii;
use yii\validators\Validator;

/**
 * Class NmiValidator
 * @package app\validators
 */
class NmiValidator extends Validator
{
    /**
     * @var string
     */
    public $pattern = '/^[0-9a-z]{11}$/i';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->message === null) {
            $this->message = Yii::t('app', '{attribute} is not valid.');
        }
    }

    /**
     * @link http://www.aemo.com.au/Electricity/Policies-and-Procedures/Retail-and-Metering/National-Metering-Identifier-Procedure
     * @param $value
     * @return array|null
     */
    protected function validateValue($value)
    {
        if ($valid = ((bool) preg_match($this->pattern, $value))) {
            $chars = array_reverse(str_split((string)$value));
            $checksum = (int)array_shift($chars);
            $total = 0;

            foreach ($chars as $i => $char) {
                $ascii = str_split(($i % 2 === 0) ? (ord($char) * 2) : ord($char));
                $total += array_sum($ascii);
            }

            $calc = (int)((floor($total / 10) + 1) * 10) - $total;
            $calc = ($calc == 10 ? 0 : $calc);

            $valid = $calc === $checksum;
        }

        return $valid ? null : [$this->message, []];
    }
}
