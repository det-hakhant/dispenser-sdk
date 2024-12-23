<?php

namespace Hakhant\Dispenser\Utils;

trait HasProtocol
{
    // Parse the frame and remove CRC if valid
    public function parseFrame(string $frame)
    {
        if ($this->validateFrame($frame)) {
            return substr($frame, 0, strlen($frame) - 2); // Remove CRC
        }

        return null; // Return null if frame is invalid
    }

    // Build the frame with CRC appended
    public function buildFrame(string $frame)
    {
        $crc = $this->calculateFrame($frame); // Calculate CRC

        // Build and return frame with CRC appended (in binary form)
        $appended = $frame . $crc;

        return $appended;
    }

    // Calculate CRC for the given frame
    public function calculateFrame(string $frame, bool $low = true)
    {
        // Initialize CRC to 0xFFFF
        $crc = 0xFFFF;

        // Iterate through each byte of the frame
        for ($i = 0; $i < strlen($frame); $i++) {
            // XOR the byte with the CRC
            $crc ^= ord($frame[$i]);

            // Perform the bitwise CRC calculation
            for ($j = 8; $j; $j--) {
                if ($crc & 0x0001) {
                    $crc >>= 1;
                    $crc ^= 0xA001;
                } else {
                    $crc >>= 1;
                }
            }
        }

        // Return CRC in either low-byte or high-byte first format
        $calculated = $low ? chr($crc & 0xFF) . chr($crc >> 8) : chr($crc >> 8) . chr($crc & 0xFF);

        return $calculated;
    }

    // Validate the frame by checking if the CRC matches
    public function validateFrame(string $frame, bool $low = true)
    {
        $frame = trim($frame); // Trim the frame to avoid trailing whitespaces causing issues
        $length = strlen($frame);

        // Ensure frame length is at least 2 bytes (for CRC)
        if ($length < 2) {
            return false;
        }

        // Extract payload (frame without CRC) and received CRC from the frame
        $payload = substr($frame, 0, $length - 2);
        $receivedCrc = substr($frame, $length - 2);

        // Calculate CRC for the payload (in binary format)
        $calculatedCrc = $this->calculateFrame($payload, $low);

        // Compare the received and calculated CRCs (binary comparison)
        return $calculatedCrc === $receivedCrc;
    }

    // Utility function to convert hexadecimal to binary string for debugging purposes
    public function hexToBin(string $frame)
    {
        return bin2hex($frame);
    }

    // Utility function to convert binary to hexadecimal string for debugging purposes
    public function binToHex(string $frame)
    {
        return hex2bin($frame);
    }
}
