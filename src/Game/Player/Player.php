<?php

namespace Game\Player;

use Game\CombatantInterface;
use Game\Items\ItemInterface;

/**
 * Class Player
 * @package Game\Player
 */
class Player implements CombatantInterface
{
    /**
     * @var
     */
    private $name;
    /**
     * @var int
     */
    private $hitPoint = 1000;
    /**
     * @var array
     */
    private $equipment = [];

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

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
     * @return bool
     */
    public function isDead(): bool
    {
        return (bool) $this->hitPoint <= 0;
    }

    /**
     * @param int $damage
     * @return int
     */
    public function damage(int $damage): int
    {
        if (!$this->isDead()) {
            foreach ($this->equipment as $equipment) {
                if (defined(get_class($equipment) . '::DAMAGE_REDUCER_MULTIPLIER')) {
                    $damage = $damage * $equipment::DAMAGE_REDUCER_MULTIPLIER;
                }
            }

            $this->setHitPoint($this->getHitPoint() - $damage);
        }

        return $this->getHitPoint();
    }

    /**
     * @param ItemInterface $item
     */
    public function equip(ItemInterface $item) : void
    {
        if (!$this->hasEquipped($item)) {
            $this->equipment[] = $item;
        }
    }

    /**
     * @param ItemInterface $item
     * @return bool
     */
    public function hasEquipped(ItemInterface $item): bool
    {
        foreach ($this->equipment as $equipment) {
            if (is_a($item, get_class($equipment))) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public function getEquipment() : array
    {
        return $this->equipment;
    }
}
