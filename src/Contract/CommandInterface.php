<?php

namespace Masyasmv\OtusMacroCommands\Contract;

use MongoDB\Driver\Exception\CommandException;

interface CommandInterface
{
    /**
     * Executes the command on the given subject.
     *
     * @param object $subject
     * @throws CommandException on failure
     */
    public function execute(object $subject): void;
}