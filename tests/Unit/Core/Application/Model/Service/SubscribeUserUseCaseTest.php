<?php

namespace Tests\Core\Application\Model\Service;

use Dddtest\Core\Application\Model\Service\SubscribeUserCommandRequest;
use Dddtest\Core\Application\Model\Service\SubscribeUserCommandResponse;
use Dddtest\Core\Application\Model\Service\SubscribeUserUseCase;
use Dddtest\Core\Domain\Model\Entity\User;
use Dddtest\Core\Domain\Model\Service\SubscribeUserService;
use Dddtest\SharedKernel\Application\Model\Service\BaseUseCase;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class SubscribeUserUseCaseTest extends TestCase
{
    const FAKE_VALID_EMAIL = 'edu.does.test@ulabox.tech';
    const FAKE_INVALID_EMAIL ='aninvalidmail.com';

    /** @var SubscribeUserService | \PHPUnit_Framework_MockObject_MockObject */
    private $subscribeUserServiceMock;

    /** @var SubscribeUserUseCase */
    private $subscribeUserUseCase;

    public function setUp()
    {
        $this->subscribeUserServiceMock = $this->getMockBuilder(SubscribeUserService::class)
            ->disableOriginalConstructor()->getMock();

        $this->subscribeUserUseCase = new SubscribeUserUseCase(
            $this->subscribeUserServiceMock
        );
    }

    public function testThatWithProperParametersAnSpecificResponseWillBeReturned()
    {
        $fakeUuid = Uuid::uuid4()->toString();
        $fakeUser = User::subscribe($fakeUuid, self::FAKE_VALID_EMAIL);
        $this->subscribeUserServiceMock->expects($this->once())
            ->method('subscribe')
            ->with(self::FAKE_VALID_EMAIL)
            ->willReturn($fakeUser);

        $fakeRequest = new SubscribeUserCommandRequest(self::FAKE_VALID_EMAIL);
        $response = $this->subscribeUserUseCase->handle($fakeRequest);

        $this->assertInstanceOf(SubscribeUserCommandResponse::class,$response);
        $this->assertEquals(BaseUseCase::STATUS_OK,$response->getStatus());
        $this->assertEquals(self::FAKE_VALID_EMAIL,$response->getResponse()['email']);
        $this->assertEquals($fakeUuid, $response->getResponse()['id']);
    }

    public function testThatIfAnExceptionIsThrownAnEvenMoreSpecificResponseWillBeReturned()
    {
        $this->subscribeUserServiceMock->expects($this->once())
            ->method('subscribe')
            ->with(self::FAKE_INVALID_EMAIL)
            ->willThrowException(new \InvalidArgumentException());

        $fakeRequest = new SubscribeUserCommandRequest(self::FAKE_INVALID_EMAIL);
        $response = $this->subscribeUserUseCase->handle($fakeRequest);

        $this->assertInstanceOf(SubscribeUserCommandResponse::class,$response);
        $this->assertEquals($response->getStatus(),BaseUseCase::STATUS_FAIL);
        $this->assertEquals("",$response->getResponse()['failMessage']);

    }
}
