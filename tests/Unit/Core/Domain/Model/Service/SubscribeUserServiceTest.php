<?php

namespace Tests\Core\Domain\Model\Service;

use Dddtest\Core\Domain\Model\Entity\User;
use Dddtest\Core\Domain\Model\Service\SubscribeUserService;
use Dddtest\Core\Domain\Model\ValueObject\UserEmail;
use Dddtest\Core\Domain\Model\ValueObject\UserId;
use Dddtest\SharedKernel\Domain\Service\IdentityProviderInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

class SubscribeUserServiceTest extends TestCase
{
    const FAKE_EMAIL = 'hi@wwannabehired.com';
    const FAKE_ID = 'c7c3b12b-da11-4300-b90a-538b935ea089';

    /** @var IdentityProviderInterface | ObjectProphecy */
    private $identityProviderMock;

    /** @var SubscribeUserService */
    private $subscribeUserService;

    public function setUp()
    {
        $this->identityProviderMock = $this->prophesize(IdentityProviderInterface::class);

        $this->subscribeUserService = new SubscribeUserService(
            $this->identityProviderMock->reveal()
        );
    }

    public function testThatWithProperParametersTheResultWillBeTheExpected()
    {
        $this->identityProviderMock->provide()->willReturn(self::FAKE_ID);
        $actualResponse = $this->subscribeUserService->subscribe(self::FAKE_EMAIL);

        $this->assertInstanceOf(User::class, $actualResponse);
        $this->assertInstanceOf(UserEmail::class, $actualResponse->email());
        $this->assertEquals(
            $actualResponse->email()->value(), self::FAKE_EMAIL
        );
        $this->assertInstanceOf(UserId::class, $actualResponse->id());
        $this->assertInternalType("string", $actualResponse->id()->value());
    }

}
