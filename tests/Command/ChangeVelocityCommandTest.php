<?php

use Masyasmv\OtusMacroCommands\Command\ChangeVelocityCommand;
use Masyasmv\OtusMacroCommands\Contract\VelocityAware;
use Masyasmv\OtusMacroCommands\ValueObject\Vector2D;
use PHPUnit\Framework\TestCase;

class ChangeVelocityCommandTest extends TestCase
{
    public function testSkipsNonVelocityAware(): void
    {
        $cmd = new ChangeVelocityCommand(90);
        $obj = new stdClass();
        $cmd->execute($obj);
        $this->addToAssertionCount(1);
    }

    public function testRotatesVelocity(): void
    {
        $obj = new class implements VelocityAware {
            private Vector2D $vel;

            public function __construct()
            {
                $this->vel = new Vector2D(1, 0);
            }

            public function getVelocity(): Vector2D
            {
                return $this->vel;
            }

            public function setVelocity(Vector2D $v): void
            {
                $this->vel = $v;
            }
        };
        $cmd = new ChangeVelocityCommand(90);
        $cmd->execute($obj);
        $out = $obj->getVelocity();
        $this->assertEqualsWithDelta(0, $out->getX(), 0.001);
        $this->assertEqualsWithDelta(1, $out->getY(), 0.001);
    }
}