<?php

require_once "Interfaces/ZooKeeper.php";

class Keeper implements ZooKeeper {

    /**
     * Don't overthink this
     * @param array $animals
     * @return array
     */
    public function feedAnimals(array $animals): array
    {
        /** @var Animal $animal */
        foreach($animals as $animal) {
            $animal->feed();
        }
        return $animals;
    }

    /**
     * @param array $animals
     * @return array
     */
    public function herdAnimals(array $animals): array
    {
        /** @var Animal $animal */
        foreach($animals as $animal) {

            if ($animal instanceof Bird) {
                $animal->moveToHabitat(Zoo::HABITAT_CAGE);
                continue;
            }

            if ($animal instanceof Shark) {
                $animal->moveToHabitat(Zoo::HABITAT_POOL);
                continue;
            }

            if ($animal instanceof Cheetah) {
                $animal->moveToHabitat(Zoo::HABITAT_ENCLOSURE);
                continue;
            }
        }
        return $animals;
    }

}
