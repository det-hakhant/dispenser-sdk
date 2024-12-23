<?php

it('can parse frame and return without crc', function() {
    // Frame with CRC in hex
    $frame = $this->binToHex('30313032cb3e'); 
    // Parse the frame and remove CRC
    $parsed = $this->parseFrame($frame);
    
    expect($parsed)->toBe('0102');
});

it('can build frame and return as hex value', function() {
    // Build the frame with CRC appended
    $build = $this->buildFrame('0102');
    // Convert the frame to binary
    $frame = $this->hexToBin($build);

    expect($frame)->toBe('30313032cb3e');
});

it('can calculate crc for frame', function() {
    // Calculate the CRC for the frame
    $frame = $this->calculateFrame('0102');
    // convert the CRC to hex
    $crc = $this->hexToBin($frame);
    // Check the CRC in hex
    expect($crc)->toBe('cb3e'); // The expected CRC in hexadecimal
});

it('can validate frame and return true', function() {
    // Frame with CRC in hex
    $frame = $this->binToHex('30313032cb3e');
    // Validate the frame with the correct CRC
    $valid = $this->validateFrame($frame);
    // Validate the frame with the correct CRC
    expect($valid)->toBeTrue();
});

it('can validate frame and return false', function() {
    // Frame with incorrect CRC in hex
    $frame = $this->binToHex('30313032cb3f'); 
    // Validate the frame with the incorrect CRC
    $valid = $this->validateFrame($frame);
    
    expect($valid)->toBeFalse();
});

it('can convert hex to binary', function() {
    // Convert the binary value to hex
    $frame = $this->binToHex('0102');
    // Convert the hex value to binary
    $bin = $this->hexToBin($frame);

    expect($bin)->toBe('0102');
});

it('can convert binary to hex', function() {
    // Convert the hex value to binary
    $frame = $this->hexToBin('0101');
    // Convert the binary value to hex
    $hex = $this->binToHex($frame);

    expect($hex)->toBe('0101');
});
