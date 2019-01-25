<?php

namespace Tests\Core\Domain\Model\ValueObject;

use Dddtest\Core\Domain\Model\ValueObject\UserId;
use PHPUnit\Framework\TestCase;

class UserIdTest extends TestCase
{
    const FAKE_VALID_USER_ID = 'c7c3b12b-da11-4300-b90a-538b935ea089';

    public function testThatWithAProperParameterThereWillBeProperCreation()
    {
        $result = new UserId(self::FAKE_VALID_USER_ID);
        $this->assertInternalType('string', $result->value());
        $this->assertEquals(self::FAKE_VALID_USER_ID, $result->value());
    }

    public function testThatInvalidParametersWillResultInNoObjectCreation()
    {
        $this->expectException(\InvalidArgumentException::class);
        $value = new \stdClass();
        $result = new UserId($value);
    }
}
