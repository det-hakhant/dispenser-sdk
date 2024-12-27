<?php

namespace Hakhant\Dispensers\Protocols;

use Exception;
use Hakhant\Dispensers\Interfaces\ProtocolInterface;
use Hakhant\Dispensers\Interfaces\CommunicationInterface;

class RedstarProtocol implements ProtocolInterface
{
     protected CommunicationInterface $communication;
     public function __construct(CommunicationInterface $communication)
     {
          $this->communication = $communication;
     }

     public function readFrame(array $frame)
     {
         $response = $this->communication->receive();

         if(empty($response) || strlen($response) < 2) {
             throw new Exception('No response from device');
         }

         $bytes = array_map('ord', str_split($response));

         $length = count($bytes) - 2;  // Exclude CRC

         $calculate = $this->calculate(array_slice($bytes, 0, $length));

         $received = ($bytes[$length + 1] << 8) | $bytes[$length];

         if($calculate !== $received) {
             throw new Exception('CRC mismatch');
         }

         return $response;
     }

     public function sendFrame(string $address, string $function, array $data)
     {
         $frame = $this->buildFrame($address, $function, $data);

         $binaryFrame = implode('', array_map('chr', $frame));

         $frame = $this->communication->send($binaryFrame);

         return $frame;
     }

     protected function buildFrame(string $address, string $function, array $data)
     {
         $frame = [];

         $frame[] = hexdec($address);

         $frame[] = hexdec($function);

         foreach($data as $value) {
           $frame[] = hexdec($value);
         }

         $crc = $this->calculate($frame);

         $frame[] = $crc & 0xFF;         // Low byte of CRC

         $frame[] = ($crc >> 8) & 0xFF; // High byte of CRC

         return $frame;
     }

     protected function calculate(array $data): int
     {
         $crc = 0xFFFF;
 
         foreach ($data as $byte) {
             $crc ^= $byte;
             for ($i = 0; $i < 8; $i++) {
                 if ($crc & 0x0001) {
                     $crc = ($crc >> 1) ^ 0xA001;
                 } else {
                     $crc >>= 1;
                 }
             }
         }
 
         return $crc & 0xFFFF;
     }
}