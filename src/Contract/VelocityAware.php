<?php

namespace App\Contract;

use App\ValueObject\Vector2D;

interface VelocityAware
{
    public function getVelocity(): Vector2D;
}
