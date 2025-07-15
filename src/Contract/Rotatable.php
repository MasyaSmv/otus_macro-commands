<?php

namespace App\Contract;

interface Rotatable
{
    public function getAngle(): float;
    public function setAngle(float $angle): void;
}
