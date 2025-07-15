<?php

use Masyasmv\OtusMacroCommands\Command\RotateCommand;
use Masyasmv\OtusMacroCommands\Contract\Rotatable;
use Masyasmv\OtusMacroCommands\Contract\RotatorInterface;
use Masyasmv\OtusMacroCommands\Exception\CommandException;
use PHPUnit\Framework\TestCase;

class RotateCommandTest extends TestCase
{
    /**
     * @return void
     * @throws CommandException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testRotateAndChangeVelocity(): void
    {
        $rotator = $this->createMock(RotatorInterface::class);
        $rotator
            ->expects($this->once())
            ->method('rotate')
            ->with(
                $this->isInstanceOf(Rotatable::class),
                $this->equalTo(45.0),
            );

        // «Анонимный» Rotatable, хранящий угол в свойстве float
        $obj = new class implements Rotatable {
            private float $angle = 0.0;

            public function getAngle(): float
            {
                return $this->angle;
            }

            public function setAngle(float $angle): void
            {
                $this->angle = $angle;
            }
        };

        $cmd = new RotateCommand($rotator, 45.0);
        $cmd->execute($obj);

        // если mock не сработал — тест упадёт, иначе засчитываем
        $this->addToAssertionCount(1);
    }

    /**
     * @return void
     * @throws CommandException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testThrowsIfSubjectIsNotRotatable(): void
    {
        // мок ротатора (не будет вызван)
        $rotator = $this->createMock(RotatorInterface::class);

        $cmd = new RotateCommand($rotator, 45.0);

        $this->expectException(CommandException::class);

        // объект НЕ реализует Rotatable
        $cmd->execute(new \stdClass());
    }
}