<?php

namespace Game\Bees\Types;

use Game\Bees\BeeAbstract;

/**
 * Class WorkerBee
 * @package Game\Bees\Types
 */
class WorkerBee extends BeeAbstract
{
    /**
     * WorkerBee constructor.
     * @param string $type
     * @param int $hitPoint
     */
    public function __construct(string $type = WorkerBeeType::class, int $hitPoint = 75)
    {
        $this->setType(new $type());
        $this->setHitPoint($hitPoint);
        $this->setDamage(10);
    }
}
