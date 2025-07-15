<?php

namespace Masyasmv\OtusMacroCommands\Command;

use Masyasmv\OtusMacroCommands\Contract\CommandInterface;
use Masyasmv\OtusMacroCommands\Exception\CommandException;
use Masyasmv\OtusMacroCommands\ValueObject\FuelTank;

class CheckFuelCommand implements CommandInterface
{
    private FuelTank $tank;

    public function __construct(FuelTank $tank)
    {
        $this->tank = $tank;
    }

    /**
     * @param object $subject
     *
     * @return void
     * @throws CommandException
     */
    public function execute(object $subject): void
    {
        if ($this->tank->getFuelLevel() < $this->tank->getConsumptionRate()) {
            throw new CommandException('Insufficient fuel');
        }
    }
}