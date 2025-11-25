<?php

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Payum\Bundle\PayumBundle\Validator\Constraints\CreditCardDate;

class CreditCardValidator
{
    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraints('number', [
            new Assert\NotBlank(groups: ['Payum']),
            new Assert\Luhn(groups: ['Payum']),
        ]);

        $metadata->addPropertyConstraints('holder', [
            new Assert\NotBlank(groups: ['Payum']),
            new Assert\Length(min: 4, groups: ['Payum']),
        ]);

        $metadata->addPropertyConstraints('securityCode', [
            new Assert\NotBlank(groups: ['Payum']),
            new Assert\Length(min: 3, max: 4, groups: ['Payum']),
        ]);

        $metadata->addPropertyConstraints('expireAt', [
            new Assert\NotBlank(groups: ['Payum']),
            new Assert\Type(\DateTimeInterface::class, groups: ['Payum']),
            new CreditCardDate(min: 'today', groups: ['Payum']),
        ]);
    }
}
