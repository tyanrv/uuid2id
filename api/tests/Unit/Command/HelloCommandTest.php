<?php

declare(strict_types=1);


namespace Test\Unit\Command;


use App\Console\HelloCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

class HelloCommandTest extends TestCase
{
    public function testCommandName(): void
    {
        $command = new HelloCommand();

        self::assertEquals('hello', $command->getName());
        self::assertEquals('Hello command', $command->getDescription());
    }

    public function testExecute(): void
    {
        $command = new HelloCommand();

        $tester = new CommandTester($command);
        $tester->execute([],[]);
        self::assertEquals('Hello!', str_replace("\n", "", $tester->getDisplay()));
        self::assertEquals(Command::SUCCESS, $tester->getStatusCode());
    }
}