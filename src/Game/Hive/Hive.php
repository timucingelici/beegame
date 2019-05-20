<?php
namespace Game\Hive;

use Game\Bees\BeeInterface;
use Game\Bees\Types\DroneBeeType;
use Game\Bees\Types\QueenBee;
use Game\Bees\Types\QueenBeeType;
use Game\Bees\Types\WorkerBeeType;
use Game\CombatantInterface;

class Hive implements CombatantInterface
{
    private $accepts = [
        QueenBeeType::class => 1,
        DroneBeeType::class => 8,
        WorkerBeeType::class => 5
    ];

    private $bees = [];

    public function addBee(BeeInterface $bee): bool
    {
        return $this->canAdd($bee) ? array_push($this->bees, $bee) : false;
    }

    public function getBees() : array
    {
        return $this->bees;
    }

    public function isEmpty(): bool
    {
        return count($this->bees) == 0;
    }

    private function canAdd(BeeInterface $bee): bool
    {
        $beeGroup = get_class($bee->getType());
        $numberOfBees = $this->getCount($bee);

        return $numberOfBees < $this->accepts[$beeGroup];
    }

    private function getCount(BeeInterface $bee): int
    {
        $counter = 0;

        foreach ($this->bees as $value) {
            $counter += is_a($bee, get_class($value)) ? 1 : 0;
        }

        return $counter;
    }

    public function damage(): array
    {
        $randomBee = $this->bees[ array_rand($this->bees)];
        $randomBee->damage();

        $this->removeDeadBees();

        $result = [
            'type' => $randomBee->getType(),
            'hitPoint' => $randomBee->getHitpoint(),
            'remaining' => count($this->bees)
        ];

        return $result;
    }

    private function removeDeadBees()
    {
        foreach ($this->bees as $key => $bee) {
            if ($bee->isDead() || $this->getQueen()->isDead()) {
                unset($this->bees[$key]);
            }
        }
    }

    private function getQueen()
    {
        foreach ($this->bees as $key => $bee) {
            if (is_a($bee, QueenBee::class)) {
                return $bee;
            }
        }

        // TODO: throw exception instead?
        return false;
    }
}
