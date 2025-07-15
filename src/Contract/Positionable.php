<?php

namespace App\Contract;

use App\ValueObject\Vector2D;

interface Positionable
{
    public function getPosition(): Vector2D;
    public function setPosition(Vector2D $position): void;
}
