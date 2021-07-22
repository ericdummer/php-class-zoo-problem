<?php
require_once "Exeptions/ZooException.php";

class Zoo
{


    const HABITAT_ENCLOSURE = "ENCLOSURE";
    const HABITAT_CAGE = "CAGE";
    const HABITAT_POOL = "POOL";

    private $animals = [];

    private $nephew;

    public function __construct($animals, $nephew = "Timmy")
    {
        $this->animals = $animals;
    }

    /**
     * @param $animals
     * @return bool
     * @throws ZooException
     */
    static public function validateAnimals($nephewName, $animals): bool
    {
        $foundLikesEnclosure = 0;
        $foundLikesCage = 0;
        $foundLikesPool = 0;
        $brotherIsHappy = true;

        foreach ($animals as $animal) {

            if ($animal->habitat == self::HABITAT_ENCLOSURE) {
                $foundLikesEnclosure++;
            }

            if ($animal->habitat == self::HABITAT_CAGE) {
                $foundLikesCage++;
            }

            if ($animal->habitat == self::HABITAT_POOL) {
                $foundLikesPool++;
            }
        }

        if ($foundLikesEnclosure < 1) {
            echo "There were no animals that like to run around in big enclosures. $nephewName is sad.\n";
            $brotherIsHappy = false;
        }
        if ($foundLikesCage < 1) {
            echo "There were no animals that like to fly in cages. $nephewName is sad.\n";
            $brotherIsHappy = false;
        }
        if ($foundLikesPool < 1) {
            echo "There were no animals that like to swim in pools. $nephewName is sad.\n";
            $brotherIsHappy = false;
        }
        return $brotherIsHappy;
    }

    public function processDay($animals): array
    {
        /** @var Animal $animal */
        foreach ($animals as $animal) {
            $animal->tryToEscape();
        }
        return $animals;
    }

    public function careForAnimals(ZooKeeper $keeper): void
    {
        $this->animals = $keeper->herdAnimals($this->animals);
        $this->animals = $keeper->feedAnimals($this->animals);
    }


    public function goOnTour($nephewName): bool
    {
        /**
         * What happened last night?
         */
        $animals = $this->processDay($this->animals);

        $brotherIsHappy = true;
        /** @var Animal $animal */
        foreach ($animals as $animal) {

            if ((string)$animal == '<MISSING>') {
                echo $nephewName . " went to see {$animal->name}."
                    . " He does not know what kind of animal {$animal->name} is."
                    . " $nephewName is sad\n";
                $brotherIsHappy = false;
                continue;
            } else {
                echo $nephewName . " went to see {$animal->name} the " . (string)$animal . ".";
            }

            if ($animal->hasEscaped()) {
                echo " {$animal->name} escaped. $nephewName is sad.\n";
                $brotherIsHappy = false;
                continue;
            }
            if ($animal->isHungry()) {
                echo " $nephewName thinks {$animal->name} looked hungry. $nephewName is sad.\n";
                $brotherIsHappy = false;
                continue;
            }
            echo " " . $animal->playInHabitat() . ".";

            if ($this->animalLikesAllHabitats($animal)) {
                echo " {$animal->name} seams like he would be happy in all habitat types. " .
                    "$nephewName thinks that is weird. $nephewName is sad.\n";
                $brotherIsHappy = false;
                continue;
            }

            if (!$animal->isHappy()) {
                $brotherIsHappy = false;
                echo " $nephewName does not think {$animal->name} looks happy. $nephewName is sad.\n";
            } else {
                echo " $nephewName thinks {$animal->name} looks happy. $nephewName is happy.\n";
            }
        }

        return $brotherIsHappy;
    }

    private function animalLikesAllHabitats(Animal $animal)
    {
        $reflectionMethod = new ReflectionMethod(get_class($animal), 'likesHabitat');
        $reflectionMethod->setAccessible(true);
        $enclosures = $reflectionMethod->invoke($animal, Zoo::HABITAT_ENCLOSURE);
        $pools = $reflectionMethod->invoke($animal, Zoo::HABITAT_POOL);
        $cages = $reflectionMethod->invoke($animal, Zoo::HABITAT_CAGE);
        return $enclosures && $pools && $cages;
    }
}


