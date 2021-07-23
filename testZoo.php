<?php

require_once "Zoo.php";
require_once "Saboteur.php";
/**
 * @todo
 * Include (require_once) each file you have created
 */
require_once "Keeper.php";
require_once "animals/Bird.php";
require_once "animals/Shark.php";
require_once "animals/Cheetah.php";

/**
 * @todo
 * Pick a name for you nephew
 */
$nephewName = "Timmy";

/**
 * @todo
 * Add at least 3 animals classes that extend the abstract Animal class
 * You must cover the three different habitats
 * put the class definitions in the animals folder
 */
$animals = [
    new Bird("Jimmy", Zoo::HABITAT_CAGE),
    new Shark("Zed", Zoo::HABITAT_POOL),
    new Cheetah("Chase", Zoo::HABITAT_ENCLOSURE)
];

/**
 * @todo
 * Implement the ZooKeeper Interface with a new class call Keeper.
 * Make $zooKeeper an instance of this Class
 */
//$zooKeeper = new stdClass();
$zooKeeper = new Keeper();


/**
 * DON'T update any of the following -- that would be cheating!!!!
 * =================================================================================================
 */
echo "Your brother promises to cover the costs of your failing zoo if his son is happy with a tour.\n";
$zoo = new Zoo($animals);
$saboteur = new Saboteur();
$zoo->careForAnimals($saboteur);
echo "You made the rounds and attempted to herd the animals and replenish their food.\n";
$zoo->careForAnimals($zooKeeper);
echo "Your brother brings his son $nephewName for a tour of the zoo.\n";
$brotherIsHappy = $zoo->goOnTour($nephewName);
$brotherIsHappy = $brotherIsHappy && Zoo::validateAnimals($nephewName, $animals);
if (!$brotherIsHappy) {
    echo "The tour was a disappointment. ";
    echo "$nephewName is not happy. Your brother is not happy. You lose your zoo!\n";
} else {
    echo "The tour was a success. ";
    echo "$nephewName is happy. Your brother happy. You keep your zoo!\n";
}