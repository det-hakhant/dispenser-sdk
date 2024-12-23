<?php

namespace Hakhant\Dispenser\Protocols;

use Hakhant\Dispenser\Utils\HasProtocol;
use Hakhant\Dispenser\Interfaces\ProtocolInterface;

class PrimeProtocol implements ProtocolInterface
{
    use HasProtocol;

    private $communication;

    public function __construct($communication)
    {
        $this->communication = $communication;
    }

    public function handle(string $frame)
    {
        $message = $this->buildFrame($frame);

        if (isset($this->communication)) {
            // Ensure communication is available before sending
            $this->communication->send($message);

            return $this->communication->receive();
        } else {
            throw new \Exception('Communication object is not set');
        }
    }
}