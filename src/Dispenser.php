<?php

namespace Hakhant\Dispensers;

use Exception;
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

    public function send(string $address, string $function, array $data)
    {
        $frame = $this->protocol->sendFrame($address, $function, $data);

        if(empty($frame)) {
            return 'Frame is empty';
        }
        
        return $this->protocol->readFrame($frame);
    }
}