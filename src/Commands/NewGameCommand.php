<?php

namespace Commands;

use Game\Bees\Types\DroneBee;
use Game\Bees\Types\QueenBee;
use Game\Bees\Types\WorkerBee;
use Game\CombatManager;
use Game\Hive\Hive;
use Game\Items\BeeSuit;
use Game\Player\Player;
use \Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

/**
 * Class NewGameCommand
 * @package Commands
 */
class NewGameCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'new-game';

    /**
     * NewGameCommand constructor.
     * @param null $name
     */
    public function __construct($name = null)
    {
        parent::__construct($name);
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription("Creates a new game instance...");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Set helpers
        $helper = $this->getHelper('question');

        // Set styles
        $this->setStyles($output);


        // Display the intro text...
        $output->writeln("<info>A wild adventurers appears...</info>");

        // Ask the player for their name...
        $question = new Question("<conversation>Oh hello there... I used to be an adventurer like you. Then I took a sting in the knee. Anyway, let me know what's your name? </conversation>");
        $playerName = $helper->ask($input, $output, $question);

        if (!$playerName) {
            $output->writeln("<conversation>Oh okay... May be another time then...<conversation>");
            $this->endGame($output);
            return;
        }

        // Prepare the player, hive and initiate the combat manager...
        $player = new Player();
        $player->setName($playerName);
        $player->equip(new BeeSuit());

        $hive = new Hive();

        // Add 1 Queen Bee
        $hive->addBee(new QueenBee());

        // 5 Worker
        for ($c=0; $c<5; $c++) {
            $hive->addBee(new WorkerBee());
        }

        // 8 Drone Bees
        for ($c=0; $c<8; $c++) {
            $hive->addBee(new DroneBee());
        }

        $combatManager = new CombatManager();
        $combatManager->setAttacker($player);
        $combatManager->setDefender($hive);

        // Give player the task
        $this->printTheQuest($output, $player);

        // Start the game loop...

        while (true) {
            $beesLeft = count($hive->getBees());

            if (!$beesLeft) {
                $output->writeln("<conversation>Congratulations {$player->getName()}! You defeated all the bees!</conversation>");
                break;
            }

            $question = new Question("<spell>? </spell>");
            $command = $helper->ask($input, $output, $question);

            if (!$command) {
                $output->writeln("<log>You should cast a spell by typing! Here is the list of the spells you can use at this level: <spells>hit, mom! and exit</spells></log>");
                continue;
            }

            switch ($command) {
                case "exit":
                case "mom!":
                    $output->writeln("<log>Hold on! Teleporting you to the home...</log>");
                    break 2;
                    break;
                case "hit":
                    $result = $combatManager->getDefender()->damage();

                    if ($result) {
                        $output->writeln("<combat>Direct hit to a {$result['type']}! " . ($result['hitPoint'] <= 0 ? "It's dead!" : "It has {$result['hitPoint']} hit points left!") . "</combat>");
                        $output->writeln("<combat>There are {$result['remaining']} bees left in the hive!</combat>");
                    }
                    break;
                default:
                    $output->writeln("<log>Let's not open a portal to the hell...</log>");
            }
        }

        // Game ends here. Display the results...
        $this->endGame($output);
    }

    /**
     * @param OutputInterface $output
     * @param null $stats
     */
    private function endGame(OutputInterface $output, $stats = null): void
    {
        $output->writeln('<conversation>Thanks for playing...</conversation>');

        if ($stats) {
            // TODO: Print the stats
        }
    }

    /**
     * @param OutputInterface $output
     */
    private function setStyles(OutputInterface &$output): void
    {
        $output->getFormatter()->setStyle('conversation', new OutputFormatterStyle('cyan'));
        $output->getFormatter()->setStyle('quest', new OutputFormatterStyle('magenta'));
        $output->getFormatter()->setStyle('spells', new OutputFormatterStyle('magenta'));
        $output->getFormatter()->setStyle('name', new OutputFormatterStyle('cyan'));
        $output->getFormatter()->setStyle('spell', new OutputFormatterStyle('cyan'));
        $output->getFormatter()->setStyle('log', new OutputFormatterStyle('cyan'));
        $output->getFormatter()->setStyle('combat', new OutputFormatterStyle('red'));
    }

    /**
     * @param OutputInterface $output
     * @param Player $player
     */
    private function printTheQuest(OutputInterface &$output, Player $player): void
    {
        $output->writeln("<quest>Nice to meet you <name>{$player->getName()}</name>! I can see that you're already ready for action!</quest>");
        $output->writeln("<quest>Do you see the bee hive over there? That thing is full of wasps, destroying our bumblebees. So it has to go!</quest>");
        $output->writeln("<quest>Your task, if you choose to accept, destroy the bees in that hive.</quest>");
        $output->writeln("<quest>Don't worry. the bee suit armor you're wearing will protect your from the bees.</quest>");
        $output->writeln("<quest>So you can go to battle in full beast mode!</quest>");
        $output->writeln("<quest></quest>");
        $output->writeln("<quest>But that doesn't mean you'll just sit there. Here are the spells you can use while fighting with those nasty creatures!</quest>");
        $output->writeln("<quest></quest>");
        $output->writeln("<quest>Type <spell>hit</spell> to attack to the first bee you see!</quest>");
        $output->writeln("<quest>Type <spell>mom!</spell> to teleport yourself to safety!</quest>");
        $output->writeln("<quest>Type <spell>exit</spell> to stop your adventure and get back to real world!</quest>");
        $output->writeln("<quest></quest>");
        $output->writeln("<quest></quest>");
    }
}
