<?php

namespace Hakhant\Dispensers\Factories;

use Hakhant\Dispensers\Interfaces\CommunicationInterface;

class CommuicationFactory
{
    public static function create(string $type, array $config): CommunicationInterface 
    {
        $className = 'Hakhant\Dispensers\Communications\\' . ucfirst($type) . 'Communication';

        if (!class_exists($className)) {
            throw new \Exception('Communication type not supported');
        }
        
        return new $className($config);
    }
}