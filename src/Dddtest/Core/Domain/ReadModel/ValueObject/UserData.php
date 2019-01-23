<?php

namespace Dddtest\Core\Domain\ReadModel\ValueObject;

use Dddtest\SharedKernel\Domain\Entity\DomainEntityInterface;

class UserData implements DomainEntityInterface
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $email;

    public function __construct(string $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}