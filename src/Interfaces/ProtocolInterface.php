<?php

namespace Hakhant\Dispensers\Interfaces;

interface ProtocolInterface
{
    public function readFrame(array $frame);

    public function sendFrame(string $address, string $function, array $data);
}