<?php
namespace webtoolsnz\validators;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberType;
use libphonenumber\PhoneNumberUtil;
use Yii;
use yii\validators\Validator;

/**
 * Class PasswordStrengthValidator
 * @package webtoolsnz\validators
 */
class PhoneNumberValidator extends Validator
{
    const FORMAT_E164 = PhoneNumberFormat::E164;
    const FORMAT_NATIONAL = PhoneNumberFormat::NATIONAL;
    const FORMAT_INTERNATIONAL = PhoneNumberFormat::INTERNATIONAL;

    const NUMBER_TYPE_FIXED_LINE = 10;
    const NUMBER_TYPE_MOBILE = 20;

    public $expectedRegion = 'ZZ';
    public $requiredRegion = null;
    public $numberType = null;
    public $format = null;

    public $message = 'Invalid Number';
    public $message_invalid_country = 'Invalid Country Code';
    public $message_required_country = 'Invalid Country Code';
    public $message_number_type = 'Invalid Number';

    private static $_allowed_formats = [
        self::FORMAT_E164,
        self::FORMAT_INTERNATIONAL,
        self::FORMAT_NATIONAL
    ];

    /* @var \libphonenumber\PhoneNumber|null */
    private $lastNumberProto;

    public function init()
    {
        parent::init();
        if ($this->expectedRegion === 'ZZ' && $this->requiredRegion !== null){
            $this->expectedRegion = $this->requiredRegion;
        }
    }

    public function validateAttribute($model, $attribute)
    {
        $result = $this->validateValue($model->$attribute);
        if (!empty($result)) {
            $this->addError($model, $attribute, $result[0], $result[1]);
            return;
        }
        if (!is_null($this->format) && $this->lastNumberProto && in_array($this->format, self::$_allowed_formats)) {
            $phoneUtil = PhoneNumberUtil::getInstance();
            $model->$attribute = $phoneUtil->format(
                $this->lastNumberProto,
                $this->format
            );
        }
    }

    protected function validateValue($value)
    {
        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $numberProto = $phoneUtil->parse($value, $this->expectedRegion);
        } catch (NumberParseException $e) {
            switch ($e->getCode()) {
                case NumberParseException::INVALID_COUNTRY_CODE:
                    return [$this->message_invalid_country, []];
                case NumberParseException::TOO_LONG:
                case NumberParseException::TOO_SHORT_NSN:
                case NumberParseException::TOO_SHORT_AFTER_IDD:
                case NumberParseException::NOT_A_NUMBER:
                default:
                    return [$this->message, []];

            }
        }
        if (!$phoneUtil->isValidNumber($numberProto)) {
            return [$this->message, []];
        }
        if ($this->requiredRegion && !$phoneUtil->isValidNumberForRegion($numberProto, $this->requiredRegion)) {
            return [$this->message_required_country, []];
        }
        if ($this->numberType) {
            $numberType = $phoneUtil->getNumberType($numberProto);
            $validNumberTypes = [];
            switch($this->numberType) {
                case self::NUMBER_TYPE_FIXED_LINE:
                    $validNumberTypes = [
                        PhoneNumberType::FIXED_LINE,
                        PhoneNumberType::FIXED_LINE_OR_MOBILE,
                    ];
                    break;
                case self::NUMBER_TYPE_MOBILE:
                    $validNumberTypes = [
                        PhoneNumberType::MOBILE,
                        PhoneNumberType::FIXED_LINE_OR_MOBILE,
                    ];
            }
            if (!in_array($numberType, $validNumberTypes)) {
                return [$this->message_number_type, []];
            }
        }

        $this->lastNumberProto = $numberProto;

        return null;
    }
}