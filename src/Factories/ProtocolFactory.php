<?php

namespace Hakhant\Dispensers\Factories;

use Hakhant\Dispensers\Interfaces\CommunicationInterface;
use Hakhant\Dispensers\Interfaces\ProtocolInterface;

class ProtocolFactory
{
    public static function create(string $protocol, CommunicationInterface $communication): ProtocolInterface
    {
        $protocol = ucfirst($protocol);

        $class = "Hakhant\\Dispensers\\Protocols\\{$protocol}Protocol";

        if (!class_exists($class)) {
            throw new \Exception("{$protocol} protocol is not supported.");
        }
        
        return new $class($communication);
    }
}