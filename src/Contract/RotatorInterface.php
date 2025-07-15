<?php

namespace Masyasmv\OtusMacroCommands\Contract;

interface RotatorInterface
{
    public function rotate(Rotatable $obj, float $deltaDeg): void;
}