<?php

namespace Tests\Unit\Service;

use Masyasmv\OtusMacroCommands\Contract\Rotatable;
use Masyasmv\OtusMacroCommands\Service\Rotator;
use PHPUnit\Framework\TestCase;

final class RotatorTest extends TestCase
{
    public static function angles(): array
    {
        return [
            [0.0, 45.0, 45.0],
            [350.0, 30.0, 20.0],
            [10.0, -30.0, 340.0],
        ];
    }

    /** @dataProvider angles */
    public function testRotateNormalizes(float $start, float $delta, float $expected): void
    {
        $obj = new class($start) implements Rotatable {
            public function __construct(private float $angle)
            {
            }

            public function getAngle(): float
            {
                return $this->angle;
            }

            public function setAngle(float $angle): void
            {
                $this->angle = $angle;
            }
        };

        (new Rotator())->rotate($obj, $delta);
        $this->assertSame($expected, $obj->getAngle());
    }
}
