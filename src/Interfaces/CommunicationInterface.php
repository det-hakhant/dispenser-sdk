<?php

namespace Hakhant\Dispensers\Interfaces;

interface CommunicationInterface
{
    public function receive();

    public function send(string $message);

    public function close();
}