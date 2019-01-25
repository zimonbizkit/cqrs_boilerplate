<?php
namespace Dddtest\Core\Domain\Model\Entity;

use Dddtest\Core\Domain\Model\Event\UserSubscribedEvent;
use Dddtest\Core\Domain\Model\ValueObject\UserEmail;
use Dddtest\Core\Domain\Model\ValueObject\UserId;
use Dddtest\SharedKernel\Domain\Entity\DomainEntityInterface;
use Dddtest\SharedKernel\Domain\Entity\Entity;

class User extends Entity Implements DomainEntityInterface
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
        $user = new self(new UserId($id), new UserEmail($email));
        $user->recordEvent(
            new UserSubscribedEvent([
                UserSubscribedEvent::EMAIL_FIELD => $email,
                UserSubscribedEvent::ID_FIELD => $id
            ])
        );

        return $user;
    }


   public function id(): UserId
    {
        return $this->id;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }
}
