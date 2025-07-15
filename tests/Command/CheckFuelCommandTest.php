<?php

use Masyasmv\OtusMacroCommands\Command\CheckFuelCommand;
use Masyasmv\OtusMacroCommands\Exception\CommandException;
use Masyasmv\OtusMacroCommands\ValueObject\FuelTank;
use PHPUnit\Framework\TestCase;

class CheckFuelCommandTest extends TestCase
{
    /**
     * @return void
     * @throws CommandException
     */
    public function testThrowsWhenInsufficientFuel(): void
    {
        $tank = new FuelTank(0, 1);
        $cmd = new CheckFuelCommand($tank);

        $this->expectException(CommandException::class);
        $cmd->execute(new stdClass());
    }

    /**
     * @return void
     * @throws CommandException
     */
    public function testPassesWhenSufficientFuel(): void
    {
        $tank = new FuelTank(10, 1);
        $cmd = new CheckFuelCommand($tank);
        $cmd->execute(new stdClass());
        $this->addToAssertionCount(1);
    }
}