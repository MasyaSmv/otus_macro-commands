<?php

namespace App\Service;

use App\Contract\Positionable;
use App\Contract\VelocityAware;

final class Mover
{
    /**
     * Сдвигает объект согласно его скорости.
     *
     * @param Positionable&VelocityAware $obj
     */
    public function move(Positionable&VelocityAware $obj): void
    {
        $current = $obj->getPosition();
        $velocity = $obj->getVelocity();
        $obj->setPosition($current->add($velocity));
    }
}
