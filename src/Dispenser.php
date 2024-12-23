<?php

namespace Hakhant\Dispensers;

use Hakhant\Dispensers\Factories\ProtocolFactory;
use Hakhant\Dispensers\Factories\CommuicationFactory;

class Dispenser
{
    protected $protocol;

    public function __construct(string $type, string $protocol, array $config)
    {
        $communication = CommuicationFactory::create($type, $config);

        $this->protocol = ProtocolFactory::create($protocol, $communication);
    }

    public function send(string $message)
    {
        return $this->protocol->handle($message);
    }
}