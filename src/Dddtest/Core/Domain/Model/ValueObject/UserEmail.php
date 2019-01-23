<?php

namespace Dddtest\Core\Domain\Model\ValueObject;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

final class UserEmail
{
    private $address;

    public function __construct($address)
    {
        self::assertValidAddress($address);

        $this->address = $address;
    }

    public function address()
    {
        return $this->address;
    }

    public function __toString()
    {
        return $this->address;
    }

    private static function assertValidAddress($address)
    {
        $validator = new EmailValidator();

        if (!$validator->isValid($address, new RFCValidation())) {
            throw new \InvalidArgumentException('Email address is not valid');
        }
    }
}
