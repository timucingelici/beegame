<?php

namespace Game;

/**
 * Class CombatManager
 * @package Game
 */
class CombatManager
{
    /**
     * @var
     */
    private $attacker;
    /**
     * @var
     */
    private $defender;
    /**
     * @var int
     */
    private $turnCount = 0;
    /**
     * @var
     */
    private $whoStarts;
    /**
     * @var
     */
    private $nextPlayer;
    /**
     * @var array
     */
    private $combatLog = [];

    /**
     * @return mixed
     */
    public function getAttacker()
    {
        return $this->attacker;
    }

    /**
     * @param mixed $attacker
     */
    public function setAttacker(CombatantInterface $attacker): void
    {
        $this->attacker = $attacker;
    }

    /**
     * @return mixed
     */
    public function getDefender()
    {
        return $this->defender;
    }

    /**
     * @param mixed $defender
     */
    public function setDefender(CombatantInterface $defender): void
    {
        $this->defender = $defender;
    }

    /**
     * @return int
     */
    public function getTurnCount(): int
    {
        return $this->turnCount;
    }

    /**
     * @param int $turnCount
     */
    public function setTurnCount(int $turnCount): void
    {
        $this->turnCount = $turnCount;
    }

    /**
     * @return mixed
     */
    public function getWhoStarted()
    {
        return $this->whoStarts;
    }


    /**
     * @param $whoStarts
     */
    public function setWhoStarts($whoStarts): void
    {
        if (!$this->whoStarts) {
            $this->whoStarts = $whoStarts;
        }
    }

    /**
     * @return mixed
     */
    public function getNextPlayer()
    {
        return $this->nextPlayer;
    }

    /**
     * @param mixed $nextPlayer
     */
    public function setNextPlayer($nextPlayer): void
    {
        $this->nextPlayer = $nextPlayer;
    }

    /**
     * @return array
     */
    public function getCombatLog(): array
    {
        return $this->combatLog;
    }
}
