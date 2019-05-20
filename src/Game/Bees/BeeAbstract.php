<?php

namespace Game\Bees;

use Game\Bees\Types\BeeTypeInterface;

/**
 * Class BeeAbstract
 * @package Game\Bees
 */
abstract class BeeAbstract implements BeeInterface
{
    /**
     * @var
     */
    private $hitPoint;
    /**
     * @var
     */
    private $type;
    /**
     * @var int
     */
    private $damage = 8;

    /**
     * @return int
     */
    public function getHitPoint(): int
    {
        return $this->hitPoint;
    }

    /**
     * @param int $hitPoint
     */
    public function setHitPoint(int $hitPoint): void
    {
        $this->hitPoint = $hitPoint;
    }

    /**
     * @return BeeTypeInterface
     */
    public function getType(): BeeTypeInterface
    {
        return $this->type;
    }

    /**
     * @param BeeTypeInterface $type
     */
    public function setType(BeeTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function isDead(): bool
    {
        return $this->hitPoint <= 0;
    }

    /**
     * @param int $damage
     * @return int
     */
    public function damage(int $damage = 0): int
    {
        $damage = $damage ? $damage : $this->damage;

        if (!$this->isDead()) {
            $this->setHitPoint($this->getHitPoint() - $damage);
        }

        return $this->getHitPoint();
    }

    /**
     * @param int $damage
     */
    public function setDamage(int $damage): void
    {
        $this->damage = $damage;
    }
}
