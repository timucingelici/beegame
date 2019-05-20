<?php

namespace Game\Bees\Types;

use Game\Bees\BeeAbstract;

/**
 * Class QueenBee
 * @package Game\Bees\Types
 */
class QueenBee extends BeeAbstract
{
    /**
     * QueenBee constructor.
     * @param string $type
     * @param int $hitPoint
     */
    public function __construct(string $type = QueenBeeType::class, int $hitPoint = 100)
    {
        $this->setType(new $type());
        $this->setHitPoint($hitPoint);
        $this->setDamage(8);
    }
}
