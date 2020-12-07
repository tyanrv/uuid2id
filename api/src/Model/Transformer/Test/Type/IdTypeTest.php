<?php

declare(strict_types=1);

namespace App\Model\Transformer\Test\Type;

use App\Model\Transformer\Type\IdType;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class IdTypeTest extends TestCase
{
    public function testSuccess(): void
    {
        $idType = new IdType($value = 10);

        self::assertEquals($value, $idType->getValue());
    }

    public function testIncorrectValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new IdType($value = 0);
    }

    public function testIncorrectValueMessage(): void
    {
        $this->expectExceptionMessage('The value must be greater than 0.');
        new IdType($value = -1);
    }

    public function testIncorrectNullMessage(): void
    {
        $this->expectExceptionMessage('The value cannot be empty.');
        new IdType(0);
    }

    public function testEqualTo(): void
    {
        $idType = new IdType(1);
        $idTypeAnother = new IdType(1);
        $idTypeAnotherYet = new IdType(2);

        self::assertTrue($idType->isEqualTo($idTypeAnother));
        self::assertFalse($idType->isEqualTo($idTypeAnotherYet));
    }
}
