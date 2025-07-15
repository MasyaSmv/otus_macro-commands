<?php

namespace Masyasmv\OtusMacroCommands\ValueObject;

final class FuelTank
{
    private float $fuelLevel;
    private float $consumptionRate;

    public function __construct(float $fuelLevel, float $consumptionRate)
    {
        $this->fuelLevel = $fuelLevel;
        $this->consumptionRate = $consumptionRate;
    }

    public function getFuelLevel(): float
    {
        return $this->fuelLevel;
    }

    public function getConsumptionRate(): float
    {
        return $this->consumptionRate;
    }

    public function burn(float $amount): void
    {
        $this->fuelLevel = max(0.0, $this->fuelLevel - $amount);
    }
}