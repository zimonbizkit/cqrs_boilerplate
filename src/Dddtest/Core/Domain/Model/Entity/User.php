<?php
namespace Dddtest\Core\Domain\Model\Entity;

use Dddtest\Core\Domain\Model\ValueObject\UserEmail;
use Dddtest\Core\Domain\Model\ValueObject\UserId;
use Dddtest\SharedKernel\Domain\Entity\DomainEntityInterface;

class User implements DomainEntityInterface
{
    private $id;

    private $email;


    private function __construct(UserId $id, UserEmail $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    public static function subscribe($id, $email)
    {
        return new self(new UserId($id), new UserEmail($email));
    }

   public function id()
    {
        return $this->id;
    }

    public function email()
    {
        return $this->email;
    }

    public function __toString()
    {
        return (string) $this->email;
    }
}
