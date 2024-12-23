<?php

namespace Hakhant\Dispensers\Interfaces;

interface ProtocolInterface
{
    public function parseFrame(string $response);

    public function buildFrame(string $frame);

    public function handle(string $frame);

}