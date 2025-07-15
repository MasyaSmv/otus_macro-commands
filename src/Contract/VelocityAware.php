<?php

namespace Masyasmv\OtusMacroCommands\Contract;


use Masyasmv\OtusMacroCommands\ValueObject\Vector2D;

interface VelocityAware
{
    public function getVelocity(): Vector2D;
}
