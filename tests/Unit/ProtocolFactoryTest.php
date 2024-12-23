<?php

use Hakhant\Dispenser\Dispenser;
use Hakhant\Dispenser\Protocols\PrimeProtocol;
use Hakhant\Dispenser\Factories\ProtocolFactory;
use Hakhant\Dispenser\Protocols\RedstarProtocol;
use Hakhant\Dispenser\Protocols\TatsunoProtocol;
use Hakhant\Dispenser\Factories\CommuicationFactory;

beforeEach(function () {
    $this->config = [
        'port' => '/dev/tty',
        'rate' => 9600,
        'parity' => 'none',    
        'length' => 8,
        'stop' => 1,
        'flow' => 'none',
    ];
});

test('can create a new instance of redstar protocol by passing redstar', function () {
    $communication = CommuicationFactory::create('serial', $this->config);

    $protocol = ProtocolFactory::create('redstar', $communication);
    
    expect($protocol)->toBeInstanceOf(RedstarProtocol::class);
});

test('can create a new instance of prime protocol by passing prime', function () {

    $communication = CommuicationFactory::create('serial', $this->config);

    $protocol = ProtocolFactory::create('prime', $communication);
    
    expect($protocol)->toBeInstanceOf(PrimeProtocol::class);

});

test('can create a new instance of tatsuno protocol by passing tatsuno', function () {
    $communication = CommuicationFactory::create('serial', $this->config);

    $protocol = ProtocolFactory::create('tatsuno', $communication);
    
    expect($protocol)->toBeInstanceOf(TatsunoProtocol::class);
});

test('can throw expection when protocol factory is unknown', function () {
    $communication = CommuicationFactory::create('serial', $this->config);

    $protocol = ProtocolFactory::create('unknown', $communication);
})->throws(\Exception::class);


