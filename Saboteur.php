<?php

require_once "Interfaces/ZooKeeper.php";

class Saboteur implements ZooKeeper {

    private function randomHabitat($excludeHabitat): String {
        $tempHabitats = [
            Zoo::HABITAT_ENCLOSURE => Zoo::HABITAT_ENCLOSURE,
            Zoo::HABITAT_CAGE => Zoo::HABITAT_CAGE,
            Zoo::HABITAT_POOL => Zoo::HABITAT_POOL
        ];
        unset($tempHabitats[$excludeHabitat]);
        return array_rand($tempHabitats);
    }

    public function feedAnimals(array $animals): array
    {
        echo "He also stole all of the animals food.\n";

        /** @var Animal $animal */
        foreach($animals as $animal) {
            $animal->isFed = false;
        }
        return $animals;
    }

    public function herdAnimals(array $animals): array
    {

        echo $this->getName() . " scattered all of the animals.\n";

        /** @var Animal $animal */
        foreach($animals as $animal) {
            $animal->moveToHabitat($this->randomHabitat($animal->habitat));
        }
        return $animals;
    }

    public function getName(): string
    {
        return "A Saboteur";
    }
}
