<?php

namespace Tests\unit;

use Game\Bees\Types\QueenBee;
use Game\Hive\Hive;
use PHPUnit\Framework\TestCase;

class HiveTest extends TestCase
{
    /**
     * @var Hive $hive
     */
    private $hive;

    /**
     * Create a new hive
     */
    public function setUp(): void
    {
        $this->hive = new Hive();
    }

    /**
     * Test if the newly created hive has any bees.
     */
    public function testHiveCanBeEmpty(): void
    {
        $this->assertTrue($this->hive->isEmpty());
    }

    /**
     * Test if the hive can add bees.
     * @return Hive
     */
    public function testAddBee(): Hive
    {
        $bee = new QueenBee();
        $this->assertTrue($this->hive->addBee($bee));

        return $this->hive;
    }

    /**
     * Test if the hive can present the bees added.
     * @depends testAddBee
     * @param Hive $hive
     */
    public function testGetBees(Hive $hive): void
    {
        $bees = $hive->getBees();

        $this->assertIsArray($bees);
        $this->assertNotEmpty($bees);
    }

    /**
     * Test if the hive follows the limits and not accepting more than one queen.
     * @depends testAddBee
     * @param Hive $hive
     */
    public function testHiveCannotAddTwoQueens(Hive $hive): void
    {
        $bee = new QueenBee();
        $this->assertFalse($hive->addBee($bee));
    }
}