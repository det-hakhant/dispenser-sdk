<?php

namespace Hakhant\Dispenser\Factories;

use Hakhant\Dispenser\Interfaces\CommunicationInterface;
use Hakhant\Dispenser\Interfaces\ProtocolInterface;

class ProtocolFactory
{
    public static function create(string $protocol, CommunicationInterface $communication): ProtocolInterface
    {
        $protocol = ucfirst($protocol);

        $class = "Hakhant\\Dispenser\\Protocols\\{$protocol}Protocol";

        if (!class_exists($class)) {
            throw new \Exception("{$protocol} protocol is not supported.");
        }
        
        return new $class($communication);
    }
}