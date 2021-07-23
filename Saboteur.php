<?php

require_once "Interfaces/ZooKeeper.php";

class Saboteur implements ZooKeeper {

    /**
     * This is used to esnure that the animal is moved somewhere it wont like
     * @param $excludeHabitat
     * @return String
     */
    private function randomHabitat($excludeHabitat): String {
        $tempHabitats = [
            Zoo::HABITAT_ENCLOSURE => Zoo::HABITAT_ENCLOSURE,
            Zoo::HABITAT_CAGE => Zoo::HABITAT_CAGE,
            Zoo::HABITAT_POOL => Zoo::HABITAT_POOL
        ];
        unset($tempHabitats[$excludeHabitat]);
        return array_rand($tempHabitats);
    }

    /**
     * Steal the food
     * @param array $animals
     * @return array
     */
    public function feedAnimals(array $animals): array
    {
        echo "He also stole all of the animals food.\n";

        /** @var Animal $animal */
        foreach($animals as $animal) {
            $animal->isFed = false;
        }
        return $animals;
    }

    /**
     * Move them somewhere they don't like
     * @param array $animals
     * @return array
     */
    public function herdAnimals(array $animals): array
    {

        echo $this->getName() . " scattered all of the animals.\n";

        /** @var Animal $animal */
        foreach($animals as $animal) {
            $animal->moveToHabitat($this->randomHabitat($animal->habitat));
        }
        return $animals;
    }

    /**
     *  Not really necessary. But show that a class can have more methods then the interface calls for
     * @return string
     */
    public function getName(): string
    {
        return "A Saboteur";
    }
}
