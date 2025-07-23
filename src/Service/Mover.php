<?php

namespace Masyasmv\OtusMacroCommands\Service;

use Masyasmv\OtusMacroCommands\Contract\Positionable;
use Masyasmv\OtusMacroCommands\Contract\VelocityAware;

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
