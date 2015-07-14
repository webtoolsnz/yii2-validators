<?php
namespace webtoolsnz\validators;

use Yii;
use yii\validators\Validator;

/**
 * Class PasswordStrengthValidator
 * @package webtoolsnz\validators
 */
class PasswordStrengthValidator extends Validator
{
    public $minimum_length = 8;
    public $minimum_lower = 1;
    public $minimum_upper = 1;
    public $minimum_digit = 1;
    public $minimum_special = 1;

    //-- The available rule constants --//
    public $message_length = '{attribute} should contain at least {n, plural, one{one character} other{# characters}}!';
    public $message_lower = '{attribute} should contain at least {n, plural, one{one lower case character} other{# lower case characters}}!';
    public $message_upper = '{attribute} should contain at least {n, plural, one{one upper case character} other{# upper case characters}}!';
    public $message_digit = '{attribute} should contain at least {n, plural, one{one numeric character} other{# numeric characters}}!';
    public $message_special = '{attribute} should contain at least {n, plural, one{one special character} other{# special characters}}!';

    public $rule_length = '/./';
    public $rule_lower = '/[a-z]/';
    public $rule_upper = '/[A-Z]/';
    public $rule_digit = '/[0-9]/';
    public $rule_special = '/[^a-z0-9]/i';
    /**
     * @inheritdoc
     */
    protected function validateValue($value)
    {
        $rules = $this->getRules();
        foreach($rules as $rule) {
            if ($rule['min']) {
                $found = preg_match_all($rule['rule'], $value);
                if ($found < $rule['min']) {
                    return [
                        $rule['message'], [
                            'n' => $rule['min'],
                            'found' => $found
                        ]
                    ];
                }
            }
        }
        return null;
    }
    private function getRules() {
        return[
            [
                'min' => $this->minimum_length,
                'rule' => $this->rule_length,
                'message' => $this->message_length,
            ],
            [
                'min' => $this->minimum_lower,
                'rule' => $this->rule_lower,
                'message' => $this->message_lower,
            ],
            [
                'min' => $this->minimum_upper,
                'rule' => $this->rule_upper,
                'message' => $this->message_upper,
            ],
            [
                'min' => $this->minimum_digit,
                'rule' => $this->rule_digit,
                'message' => $this->message_digit,
            ],
            [
                'min' => $this->minimum_special,
                'rule' => $this->rule_special,
                'message' => $this->message_special,
            ],
        ];
    }
}