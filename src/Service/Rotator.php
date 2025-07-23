<?php

namespace Masyasmv\OtusMacroCommands\Service;

use Masyasmv\OtusMacroCommands\Contract\Rotatable;
use Masyasmv\OtusMacroCommands\Contract\RotatorInterface;

final class Rotator implements RotatorInterface
{
    public function rotate(Rotatable $obj, float $deltaDeg): void
    {
        $sum = $obj->getAngle() + $deltaDeg;
        // берём остаток от деления на 360.0, чтобы не смешивать int и float
        $newAngle = fmod($sum, 360.0);
        if ($newAngle < 0.0) {
            $newAngle += 360.0;
        }

        $obj->setAngle($newAngle);
    }
}
