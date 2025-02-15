<?php

namespace Hakhant\Dispensers\Communications;

use Hakhant\Dispensers\Interfaces\CommunicationInterface;

class EthernetCommunication implements CommunicationInterface
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function receive()
    {
        // Receive message from Ethernet
    }

    public function send(string $message)
    {
        // Send message to Ethernet
    }

    public function close()
    {
        // Close connection to Ethernet
    }
}