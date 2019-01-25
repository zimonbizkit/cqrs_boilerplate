<?php

namespace Tests\Core\Domain\Model\ValueObject;

use Dddtest\Core\Domain\Model\ValueObject\UserEmail;
use PHPUnit\Framework\TestCase;

class UserEmailTest extends TestCase
{
    const FAKE_VALID_EMAIL ='hello@ulabox.com';
    const FAKE_INVALID_EMAIL = 'hihowsitgoingimtryingtobreakintothesystem';

    public function testThatWithProperEmailFormatProperObjectWillBeCreated()
    {
        $result = new UserEmail(self::FAKE_VALID_EMAIL);
        $this->assertInstanceOf(UserEmail::class, $result);
        $this->assertEquals(self::FAKE_VALID_EMAIL, $result->value());
    }

    public function testThatWithAnInvalidEmailTASpecificExceptionWillBeThrown()
    {
        $this->expectException(\InvalidArgumentException::class);
        new UserEmail(self::FAKE_INVALID_EMAIL);
    }


}
