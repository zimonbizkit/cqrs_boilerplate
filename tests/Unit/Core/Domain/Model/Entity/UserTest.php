<?php

namespace Test\Core\Domain\Model\Entity;

use Dddtest\Core\Domain\Model\Entity\User;
use Dddtest\Core\Domain\Model\Service\SubscribeUserService;
use PHPUnit\Framework\TestCase;
use Tests\Core\Domain\Model\Service\SubscribeUserServiceTest;

class UserTest extends TestCase
{
    public function testThatProperParametersWillHaveTheObjectCreatedProperly()
    {
        // XXX: Yet knowing that dependencies between tests are a very bad practice
        // XXX: did this for the sake of not rewriting the same constant across some tests
        $user = User::subscribe(
            SubscribeUserServiceTest::FAKE_ID,
            SubscribeUserServiceTest::FAKE_EMAIL
        );

        $this->assertInstanceOf(User::class, $user);
    }
}
