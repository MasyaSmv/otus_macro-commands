<?php

use Masyasmv\OtusMacroCommands\Command\BurnFuelCommand;
use Masyasmv\OtusMacroCommands\ValueObject\FuelTank;
use PHPUnit\Framework\TestCase;

class BurnFuelCommandTest extends TestCase
{
    public function testBurnsFuel(): void
    {
        $tank = new FuelTank(10, 2);
        $cmd = new BurnFuelCommand($tank);
        $cmd->execute(new stdClass());
        $this->assertEquals(8, $tank->getFuelLevel());
    }
}