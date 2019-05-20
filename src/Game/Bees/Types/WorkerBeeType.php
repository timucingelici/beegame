<?php

namespace Game\Bees\Types;

/**
 * Class WorkerBeeType
 * @package Game\Bees\Types
 */
class WorkerBeeType implements BeeTypeInterface
{
    /**
     * @return string
     */
    public function __toString()
    {
        return "Worker Bee";
    }
}
