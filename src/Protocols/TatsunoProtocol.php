<?php

namespace Hakhant\Dispensers\Protocols;

use Hakhant\Dispensers\Interfaces\ProtocolInterface;
use Hakhant\Dispensers\Utils\HasProtocol;

class TatsunoProtocol implements ProtocolInterface
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