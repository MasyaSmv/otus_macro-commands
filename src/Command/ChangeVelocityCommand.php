<?php

namespace Masyasmv\OtusMacroCommands\Command;

use Masyasmv\OtusMacroCommands\Contract\CommandInterface;
use Masyasmv\OtusMacroCommands\Contract\VelocityAware;

class ChangeVelocityCommand implements CommandInterface
{
    private float $angle;

    public function __construct(float $angle)
    {
        $this->angle = $angle;
    }

    public function execute(object $subject): void
    {
        if (!($subject instanceof VelocityAware)) {
            return;
        }

        $velocity = $subject->getVelocity();
        $rotated = $velocity->rotate($this->angle);
        $subject->setVelocity($rotated);
    }
}