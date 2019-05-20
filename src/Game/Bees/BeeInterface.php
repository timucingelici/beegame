<?php

namespace Game\Bees;

use Game\Bees\Types\BeeTypeInterface;

/**
 * Interface BeeInterface
 * @package Game\Bees
 */
interface BeeInterface
{
    /**
     * @return int
     */
    public function getHitPoint(): int;

    /**
     * @param int $hitPoint
     */
    public function setHitPoint(int $hitPoint): void;

    /**
     * @return BeeTypeInterface
     */
    public function getType(): BeeTypeInterface;

    /**
     * @param BeeTypeInterface $type
     */
    public function setType(BeeTypeInterface $type): void;

    /**
     * @return bool
     */
    public function isDead(): bool;

    /**
     * @param int $damage
     * @return int
     */
    public function damage(int $damage = 0): int;
}
