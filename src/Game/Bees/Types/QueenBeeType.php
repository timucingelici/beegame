<?php

namespace Game\Bees\Types;

/**
 * Class QueenBeeType
 * @package Game\Bees\Types
 */
class QueenBeeType implements BeeTypeInterface
{
    /**
     * @return string
     */
    public function __toString()
    {
        return "Queen Bee";
    }
}
