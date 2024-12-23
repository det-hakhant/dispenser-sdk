
# Serial Communication SDK

### The Serial Communication SDK is a PHP package designed for communicating with devices over serial ports. It simplifies the process of sending commands and receiving responses using phpSerial

### Installation

```bash

composer require hakhant/dispenser-sdk

```

### Usage 

```php

use Hakhant\Dispensers\Dispenser;

// $type = 'serial'; ( Communication Type ) 
// $protocol = 'redstar'; ( Brand Name )
// config for serial communication
$config = [
        'port' => '/dev/tty',
        'rate' => 9600,
        'parity' => 'none',    
        'length' => 8,
        'stop' => 1,
        'flow' => 'none',
];
$dispenser = new Dispenser('serial', 'redstar', $config);
 
$response = $dispenser->send('010203');

echo $response;
```

### Test

```bash

composer test

```

