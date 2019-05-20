<?php

namespace Game\Bees\Types;

use Game\Bees\BeeAbstract;

/**
 * Class DroneBee
 * @package Game\Bees\Types
 */
class DroneBee extends BeeAbstract
{
    /**
     * DroneBee constructor.
     * @param string $type
     * @param int $hitPoint
     */
    public function __construct(string $type = DroneBeeType::class, int $hitPoint = 50)
    {
        $this->setType(new $type());
        $this->setHitPoint($hitPoint);
        $this->setDamage(12);
    }
}
