<?php

namespace Game\Bees\Types;

/**
 * Class DroneBeeType
 * @package Game\Bees\Types
 */
class DroneBeeType implements BeeTypeInterface
{
    /**
     * @return string
     */
    public function __toString()
    {
        return "Drone Bee";
    }
}
