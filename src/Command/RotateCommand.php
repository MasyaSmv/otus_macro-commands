<?php

namespace Masyasmv\OtusMacroCommands\Command;

use Masyasmv\OtusMacroCommands\Contract\CommandInterface;
use Masyasmv\OtusMacroCommands\Contract\Rotatable;
use Masyasmv\OtusMacroCommands\Exception\CommandException;
use Masyasmv\OtusMacroCommands\Service\Rotator;

class RotateCommand implements CommandInterface
{
    private Rotator $rotator;
    private float $angle;

    public function __construct(Rotator $rotator, float $angle)
    {
        $this->rotator = $rotator;
        $this->angle = $angle;
    }

    /**
     * @param object $subject
     *
     * @return void
     * @throws CommandException
     */
    public function execute(object $subject): void
    {
        if (!$subject instanceof Rotatable) {
            throw new CommandException('Subject must implement Rotatable');
        }
        
        $this->rotator->rotate($subject, $this->angle);
        // Настроить вектор скорости, если применимо
        $changeVel = new ChangeVelocityCommand($this->angle);
        $changeVel->execute($subject);
    }
}