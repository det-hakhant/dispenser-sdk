<?php

namespace Hakhant\Dispenser\Communications;

use Hakhant\Dispenser\Interfaces\CommunicationInterface;
use Hakhant\Dispenser\Serials\Serial;

class SerialCommunication implements CommunicationInterface
{
    private array $config;
    private Serial $serial;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->serial = new Serial;

        $this->configure();
    }

    public function send(string $message)
    {
        $this->serial->sendMessage($message);

        return $this->receive();
    }

    public function receive()
    {
        return $this->serial->readPort();
    }

    public function close()
    {
        $this->serial->deviceClose();
    }

    private function configure()
    {
        $this->serial->deviceSet($this->config['port']);
        $this->serial->confBaudRate($this->config['rate']);
        $this->serial->confParity($this->config['parity'] ?? 'none');
        $this->serial->confCharacterLength($this->config['length'] ?? 8);
        $this->serial->confStopBits($this->config['stop'] ?? 1);
        $this->serial->confFlowControl($this->config['flow'] ?? 'none');
        $this->serial->deviceOpen();   
    }
}