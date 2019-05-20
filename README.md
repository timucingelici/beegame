# OBJECTIVE

Providing a solution to https://github.com/waxim/beegame/blob/master/BeeGame.md

# SOLUTION

* I have created an abstract class for bees and then generated the different bee types from it. I also created bee type classes, mostly to force the type checking when creating the bees.
* I have created a hive class which accepts different types of bees while limiting the number of bees for those types.
* I have created a player class, along with items and an item interface so player can equip the item and player class would only accept and item interface to equip.
* I have a combat manager with accepts an attacker and defender and manage the states between combatants.
* I have added unit tests and tried to come up with a functional test to test the actual game play.

# RESULTS

* The game is working.
* I couldn't come up with a working test for the game play, mainly due to not able to enter inputs while the game is running, so the console
 component kept aborting the command.
* Should have used observer pattern to report hive status back.
* My command class is a bit hideous, mostly because I ran out of time.
* Not so sure if creating different bee type classes were that necessary.
* I have an unused bee factory.
* I couldn't implemented the exactly what I was thinking (ie. combat manager), again, mostly because of lack of time.

# HOW TO RUN

* Clone the repo
* Run `composer install`
* Run the game with ``