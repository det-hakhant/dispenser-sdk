<?php

use Hakhant\Dispensers\Dispenser;

it('can send actual message', function() {

    $config = [
            'port' => '/dev/cu.usbserial-1110',
            'rate' => 115200,
            'parity' => 'none',    
            'length' => 8,
            'stop' => 1,
            'flow' => 'none',
    ];

    $dispenser = new Dispenser('serial', 'redstar', $config);

    $response = $dispenser->send('30', '31', []);

    expect($response)->toBe('Frame is empty');
});