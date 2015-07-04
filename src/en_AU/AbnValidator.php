<?php
namespace webtoolsnz\validators\en_AU;

use Yii;
use yii\validators\Validator;

/**
 * Class AbnValidator
 * @package app\validators
 */
class AbnValidator extends Validator
{
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
     * https://github.com/pear/Validate_AU/blob/master/Validate/AU.php
     * @param $value
     * @return array|null
     */
    protected function validateValue($value)
    {
        $value = preg_replace('/[^\d]/', '', $value);
        $weights = array(10, 1, 3, 5, 7, 9, 11, 13, 15, 17, 19);
        $mod = 89;
        $sum = 0;
        $valid = false;

        if (strlen($value) == 11) {
            $digits = str_split($value);
            $digits[0]--;

            foreach ($digits as $key => $digit) {
                $sum += $digit * $weights[$key];
            }

            $valid = ($sum % $mod) == 0;
        }

        return $valid ? null : [$this->message, []];
    }
}
