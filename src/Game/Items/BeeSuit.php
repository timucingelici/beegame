<?php

namespace Game\Items;

/**
 * Class BeeSuit
 * @package Game\Items
 */
class BeeSuit implements ItemInterface
{
    /**
     * Unique name of the item.
     */
    public const NAME = "Bee Suit";

    /**
     *  It nulls the damage taken from bees.
     */
    public const DAMAGE_REDUCER_MULTIPLIER = 0;

    /**
     * It doesn't add any additional damage.
     */
    public const DAMAGE_AMPLIFIER_MULTIPLIER = 1;
}
