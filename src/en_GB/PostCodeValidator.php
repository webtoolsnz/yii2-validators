<?php
namespace webtoolsnz\validators\en_GB;

use Yii;
use yii\validators\Validator;

/**
 * Class PostCodeValidator
 * @package webtoolsnz\validators\en_GB
 */
class PostCodeValidator extends Validator
{
    /**
     * @var string
     */
    public $pattern = '/^(GIR 0AA)|(((A[BL]|B[ABDHLNRSTX]?|C[ABFHMORTVW]|D[ADEGHLNTY]|E[HNX]?|F[KY]|G[LUY]?|H[ADGPRSUX]|I[GMPV]|JE|K[ATWY]|L[ADELNSU]?|M[EKL]?|N[EGNPRW]?|O[LX]|P[AEHLOR]|R[GHM]|S[AEGKLMNOPRSTY]?|T[ADFNQRSW]|UB|W[ADFNRSV]|YO|ZE)[1-9]?[0-9]|((E|N|NW|SE|SW|W)1|EC[1-4]|WC[12])[A-HJKMNPR-Y]|(SW|W)([2-9]|[1-9][0-9])|EC[1-9][0-9])[0-9][ABD-HJLNP-UW-Z]{2})$/i';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->message === null) {
            $this->message = Yii::t('app', '{attribute} is not a valid postcode.');
        }
    }

    /**
     * @inheritdoc
     */
    protected function validateValue($value)
    {
        $value = preg_replace('/[\s]/', '', $value);
        $valid = (bool) preg_match($this->pattern, $value);
        return $valid ? null : [$this->message, []];
    }
}
