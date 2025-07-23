<?php

namespace Tests\Unit\ValueObject;

use Masyasmv\OtusMacroCommands\ValueObject\Vector2D;
use PHPUnit\Framework\TestCase;

class Vector2DTest extends TestCase
{
    public function testAdd()
    {
        $a = new Vector2D(1, 2);
        $b = new Vector2D(3, -1);
        $sum = $a->add($b);
        $this->assertEquals([4, 1], [$sum->getX(), $sum->getY()]);
    }

    public function testWithXAndWithYProduceNewInstances(): void
    {
        $v  = new Vector2D(1, 2);

        $vx = $v->withX(10);
        $vy = $v->withY(20);

        // 1) оба вызова возвращают НОВЫЕ объекты
        $this->assertNotSame($v, $vx);
        $this->assertNotSame($v, $vy);

        // 2) меняется только нужная компонента
        $this->assertSame(10.0, $vx->getX());
        $this->assertSame(2.0,  $vx->getY());

        $this->assertSame(1.0,  $vy->getX());
        $this->assertSame(20.0, $vy->getY());
    }
}