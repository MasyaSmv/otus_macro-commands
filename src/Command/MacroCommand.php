<?php

namespace Masyasmv\OtusMacroCommands\Command;

use Exception;
use Masyasmv\OtusMacroCommands\Contract\CommandInterface;

class MacroCommand implements CommandInterface
{
    /** @var CommandInterface[] */
    private array $commands;

    public function __construct(CommandInterface ...$commands)
    {
        $this->commands = $commands;
    }

    public function execute(object $subject): void
    {
        foreach ($this->commands as $cmd) {
            $cmd->execute($subject);
        }
    }
}