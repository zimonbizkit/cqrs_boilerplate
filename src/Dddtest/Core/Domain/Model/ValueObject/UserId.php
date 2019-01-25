<?php

namespace Dddtest\Core\Domain\Model\ValueObject;

use Dddtest\SharedKernel\Domain\Entity\EntityIdInterface;

class UserId implements EntityIdInterface
{
    private $id;

    public function __construct($id)
    {
        \Assert\that($id)->string();
        $this->id = $id;
    }

    public function value(): string
    {
        return $this->id;
    }

    public function __toString()
    {
        return (string) $this->id;
    }
}
