<?php

namespace Tests\unit;

use Commands\NewGameCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class GamePlayTest extends TestCase
{
    private $application;
    private $command = 'new-game';
    private $player = 'Tim';

    private $outputs = [
        'intro' =>  "A wild adventurers appears...\n" .
                    "Oh hello there... I used to be an adventurer like you. Then I took a sting in the knee. Anyway, let me know what's your name?",

        'quest' =>  "Nice to meet you Tim! I can see that you're already ready for action!\n" .
                    "Do you see the bee hive over there? That thing is full of wasps, destroying our bumblebees. So it has to go!\n" .
                    "Your task, if you choose to accept, destroy the bees in that hive.\n" .
                    "Don't worry. the bee suit armor you're wearing will protect your from the bees.\n" .
                    "So you can go to battle in full beast mode!\n" .
                    "\n" .
                    "But that doesn't mean you'll just sit there. Here are the spells you can use while fighting with those nasty creatures!\n" .
                    "\n" .
                    "Type hit to attack to the first bee you see!\n" .
                    "Type mom! to teleport yourself to safety!\n" .
                    "Type exit to stop your adventure and get back to real world!\n" .
                    "\n" .
                    "\n" .
                    "? "
    ];

    public function testUserCanStartTheGame()
    {
        $this->application = new Application();
        $this->application->add(new NewGameCommand());

        $command = $this->application->find($this->command);
        $tester = new CommandTester($command);

        // TODO: pass the user input
        $tester->execute(['command' => $command->getName()]);


        $this->assertEquals($this->outputs['intro'] . $this->outputs['quest'], $tester->getDisplay());


    }

}