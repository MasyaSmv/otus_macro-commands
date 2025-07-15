<?php

use Masyasmv\OtusMacroCommands\Command\MacroCommand;
use Masyasmv\OtusMacroCommands\Contract\CommandInterface;
use Masyasmv\OtusMacroCommands\Exception\CommandException;
use PHPUnit\Framework\TestCase;

class MacroCommandTest extends TestCase
{
    public function testExecutesAllCommands(): void
    {
        // объект с публичным свойством-масcивом
        $subject = new \stdClass();
        $subject->log = [];           // массив-журнал

        $cmd1 = new class implements CommandInterface {
            public function execute(object $subject): void
            {
                $subject->log[] = 1;
            }
        };

        $cmd2 = new class implements CommandInterface {
            public function execute(object $subject): void
            {
                $subject->log[] = 2;
            }
        };

        $macro = new MacroCommand($cmd1, $cmd2);
        $macro->execute($subject);

        $this->assertSame([1, 2], $subject->log);
    }


    public function testStopsOnException(): void
    {
        $cmd1 = new class implements CommandInterface {
            public function execute(object $subject): void
            {
                $subject->log[] = 1;
            }
        };
        $cmd2 = new class implements CommandInterface {
            public function execute(object $subject): void
            {
                throw new CommandException('fail');
            }
        };
        $cmd3 = new class implements CommandInterface {
            public function execute(object $subject): void
            {
                $subject->log[] = 3;
            }
        };

        $macro = new MacroCommand($cmd1, $cmd2, $cmd3);
        $subject = new class {
            public array $log = [];
        };

        $this->expectException(CommandException::class);
        $macro->execute($subject);
        $this->assertSame([1], $subject->log);   // выполнена только первая
    }
}