<?php

namespace Masyasmv\OtusMacroCommands\Command;

use Masyasmv\OtusMacroCommands\Contract\CommandInterface;
use Masyasmv\OtusMacroCommands\Contract\Rotatable;
use Masyasmv\OtusMacroCommands\Contract\RotatorInterface;
use Masyasmv\OtusMacroCommands\Exception\CommandException;

class RotateCommand implements CommandInterface
{
    public function __construct(
        private RotatorInterface $rotator,
        private float $angle
    ) {
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