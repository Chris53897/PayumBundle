<?php

namespace Payum\Bundle\PayumBundle\Tests\Validator\Constraints;

use Datetime;
use Payum\Bundle\PayumBundle\Validator\Constraints\CreditCardDate;
use Payum\Bundle\PayumBundle\Validator\Constraints\CreditCardDateValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class CreditCardDateValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): CreditCardDateValidator
    {
        return new CreditCardDateValidator();
    }
}
