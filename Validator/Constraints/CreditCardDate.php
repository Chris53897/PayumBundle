<?php
/**
 * @author Marc Pantel <pantel.m@gmail.com>
 */

namespace Payum\Bundle\PayumBundle\Validator\Constraints;

use DateTime;
use Symfony\Component\Validator\Attribute\HasNamedArguments;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\MissingOptionsException;

/**
 * CreditCardDate
 */
#[\Attribute]
class CreditCardDate extends Constraint
{
    public $minMessage = 'validator.credit_card.invalidDate';

    public $invalidMessage = 'validator.credit_card.invalidDate';

    public string|DateTime $min;

    #[HasNamedArguments]
    public function __construct(string|DateTime $min, ?array $groups = null, $payload = null, array $options = [])
    {
        parent::__construct($options);

        if (null !== $min) {
            $min = new DateTime($min);
            $min->modify('last day of this month');
        }

        $options['min'] = $this->min = $min;

        parent::__construct($options, $groups, $payload);
    }
}
