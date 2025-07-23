<?php

namespace Masyasmv\OtusMacroCommands\ValueObject;

use function cos;
use function sin;

final class Vector2D
{
    private float $x;
    private float $y;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): float
    {
        return $this->x;
    }

    public function getY(): float
    {
        return $this->y;
    }

    /**
     * Возвращает новый вектор, результат сложения этого и другого.
     */
    public function add(Vector2D $other): Vector2D
    {
        return new self(
            $this->x + $other->x,
            $this->y + $other->y,
        );
    }

    /**
     * Возвращает новый вектор, повёрнутый на $angle градусов (counter-clockwise).
     */
    public function rotate(float $angle): self
    {
        $rad = deg2rad($angle);
        $cos = cos($rad);
        $sin = sin($rad);

        $newX = $this->x * $cos - $this->y * $sin;
        $newY = $this->x * $sin + $this->y * $cos;

        return new self($newX, $newY);
    }

    /**
     * Создаёт копию с заменённой компонентои X.
     */
    public function withX(float $x): Vector2D
    {
        return new self($x, $this->y);
    }

    /**
     * Создаёт копию с заменённой компонентои Y.
     */
    public function withY(float $y): Vector2D
    {
        return new self($this->x, $y);
    }
}
