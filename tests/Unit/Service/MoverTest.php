<?php
namespace Tests\Unit\Service;

use Masyasmv\OtusMacroCommands\Service\Mover;
use Masyasmv\OtusMacroCommands\Contract\Positionable;
use Masyasmv\OtusMacroCommands\Contract\VelocityAware;
use Masyasmv\OtusMacroCommands\ValueObject\Vector2D;
use PHPUnit\Framework\TestCase;

final class MoverTest extends TestCase
{
    public function testMoveShiftsPosition(): void
    {
        // анонимный «корабль», умеющий позицию и скорость
        $ship = new class implements Positionable, VelocityAware {
            private Vector2D $pos;
            private Vector2D $vel;
            public function __construct() {
                $this->pos = new Vector2D(0, 0);
                $this->vel = new Vector2D(3, -2);
            }
            public function getPosition(): Vector2D { return $this->pos; }
            public function setPosition(Vector2D $position): void { $this->pos = $position; }
            public function getVelocity(): Vector2D { return $this->vel; }
            public function setVelocity(Vector2D $v): void { $this->vel = $v; }
        };

        (new Mover())->move($ship);

        $this->assertSame(3.0, $ship->getPosition()->getX());
        $this->assertSame(-2.0, $ship->getPosition()->getY());
    }
}
