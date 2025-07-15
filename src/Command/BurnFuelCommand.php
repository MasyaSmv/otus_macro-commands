<?php

namespace Masyasmv\OtusMacroCommands\Command;

use Masyasmv\OtusMacroCommands\Contract\CommandInterface;
use Masyasmv\OtusMacroCommands\ValueObject\FuelTank;

class BurnFuelCommand implements CommandInterface
{
    private FuelTank $tank;

    public function __construct(FuelTank $tank)
    {
        $this->tank = $tank;
    }

    public function execute(object $subject): void
    {
        $this->tank->burn($this->tank->getConsumptionRate());
    }
}