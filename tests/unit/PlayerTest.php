<?php
namespace Tests\unit;


use Game\Items\BeeSuit;
use Game\Player\Player;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    public function testPlayerCanHaveAName()
    {
        $player = new Player();
        $name = "Tim";

        $player->setName($name);

        $this->assertEquals($name, $player->getName());
    }

    public function testPlayerCanTakeDamage()
    {
        $player = new Player();
        $player->setHitPoint(1000);
        $player->damage(100);

        $this->assertEquals(900, $player->getHitPoint());
    }

    public function testPlayerCanDie()
    {
        $player = new Player();
        $player->damage( $player->getHitPoint() );

        $this->assertTrue($player->isDead(), "Player should be able to die.");
    }

    public function testPlayerCanEquipItem()
    {
        $player = new Player();
        $item = new BeeSuit();

        $player->equip($item);

        $this->assertEquals([$item], $player->getEquipment());
    }

    public function testPlayerCannotTakeDamageFromABeeWhenBeeSuitIsEquipped()
    {
        $player = new Player();
        $item = new BeeSuit();

        $player->setHitPoint(1000);
        $player->equip($item);
        $player->damage(10);

        $this->assertEquals(1000, $player->getHitPoint());
    }
}