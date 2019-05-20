<?php

namespace Tests\unit;

use Game\Bees\Types\DroneBee;
use Game\Bees\Types\QueenBee;
use Game\Bees\Types\WorkerBee;
use PHPUnit\Framework\TestCase;

class BeeTest extends TestCase
{

    public function testDifferentBeeTypesHasDifferentDefaults()
    {
        $queenBee = new QueenBee();
        $droneBee = new DroneBee();
        $workerBee = new WorkerBee();

        $this->assertEquals(100, $queenBee->getHitPoint());
        $this->assertEquals(50, $droneBee->getHitPoint());
        $this->assertEquals(75, $workerBee->getHitPoint());
    }

    public function testBeesCanTakeDamage()
    {
        $bee = new WorkerBee();
        $bee->setHitPoint(100);
        $bee->damage(10);

        $this->assertEquals(90, $bee->getHitPoint());
    }

    public function testBeesCanDie()
    {
        $bee = new WorkerBee();
        $bee->damage( $bee->getHitPoint() );

        $this->assertTrue($bee->isDead(), "Bees should be able to die.");
    }

}