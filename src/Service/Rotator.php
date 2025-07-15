<?php

namespace App\Service;

use App\Contract\Rotatable;

final class Rotator
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
