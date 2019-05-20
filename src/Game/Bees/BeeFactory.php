<?php

namespace Game\Bees;

use Game\Bees\Types\BeeTypeInterface;
use Game\Bees\Types\DroneBee;
use Game\Bees\Types\DroneBeeType;
use Game\Bees\Types\QueenBee;
use Game\Bees\Types\QueenBeeType;
use Game\Bees\Types\WorkerBee;
use Game\Bees\Types\WorkerBeeType;

/**
 * Class BeeFactory
 * @package Game\Bees
 */
class BeeFactory
{
    /**
     * @param BeeTypeInterface $type
     * @return BeeInterface
     */
    public static function create(BeeTypeInterface $type) : BeeInterface
    {
        switch ($type) {
            case is_a($type, QueenBeeType::class):
                return new QueenBee();
            case is_a($type, WorkerBeeType::class):
                return new WorkerBee();
            case is_a($type, DroneBeeType::class):
                return new DroneBee();
        }
    }
}
