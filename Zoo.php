<?php

class Zoo
{
    const HABITAT_ENCLOSURE = "ENCLOSURE";
    const HABITAT_CAGE = "CAGE";
    const HABITAT_POOL = "POOL";

    private $animals = [];

    /**
     * Zoo constructor.
     * @param $animals
     */
    public function __construct($animals)
    {
        $this->animals = $animals;
    }

    static protected function animalLikesHabitat(Animal $animal, $habitat) {
        $reflectionMethod = new ReflectionMethod(get_class($animal), 'likesHabitat');
        $reflectionMethod->setAccessible(true);
        return $reflectionMethod->invoke($animal, $habitat);
    }

    /**
     * @param $nephewName
     * @param $animals
     * @return bool
     */
    static public function validateAnimals($nephewName, $animals): bool
    {
        $foundLikesEnclosure = 0;
        $foundLikesCage = 0;
        $foundLikesPool = 0;
        $brotherIsHappy = true;

        /** @var Animal $animal */
        foreach ($animals as $animal) {

            if (self::animalLikesHabitat($animal, self::HABITAT_ENCLOSURE)) {
                $foundLikesEnclosure++;
            }

            if (self::animalLikesHabitat($animal, self::HABITAT_CAGE)) {
                $foundLikesCage++;
            }

            if (self::animalLikesHabitat($animal, self::HABITAT_POOL)) {
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

    /**
     * This method is called after you have had a chance to clean up (careForAnimals)
     * If an animal is not in an enclosure that it likes, it escapes.
     * @param $animals
     * @return array
     */
    public function processDay($animals): array
    {
        /** @var Animal $animal */
        foreach ($animals as $animal) {
            $animal->tryToEscape();
        }
        return $animals;
    }

    /**
     * ZooKeeper could be a bad agent (Saboteur)
     * @param ZooKeeper $keeper
     */
    public function careForAnimals(ZooKeeper $keeper): void
    {
        $this->animals = $keeper->herdAnimals($this->animals);
        $this->animals = $keeper->feedAnimals($this->animals);
    }


    /**
     * 0. Calls processDay just before your nephew tours the zoo
     * 1. Checks to see if the type of the animal is know. Calls $animal->__toString() or (string) $animal)
     * 2. Checks to see if the animal has escaped. Calls $animal->likesHabitat. If no implemented correctly the animal will escape)
     * 3. Checks to see if the animal has food. calls $animal->isHungry
     * 4. Checks to see if the animal plays. calls $animal->playInHabitat. If animal can't play correctly it is not happy.
     * 5. Checks to maks sure the animal only like 1 habitat
     * 6. Checks to make sure the animal is happy. Calls $animal->isHappy
     *
     * @param $nephewName
     * @return bool
     */
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
            try{
                if (!$this->animalLikesOnlyOneHabitats($animal)) {
                    echo " {$animal->name} seams like he would be happy in any habitat type. " .
                        "$nephewName thinks that is weird. $nephewName is sad.\n";
                    $brotherIsHappy = false;
                    continue;
                }
            } catch (Exception $e) {
                echo "(exception thrown)\n";
                echo " {$animal->name} seams like he wouldn't be happy in any habitat types. " .
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

    /**
     * @param Animal $animal
     * @return bool
     * @throws ReflectionException
     */
    private function animalLikesOnlyOneHabitats(Animal $animal): bool
    {
        $reflectionMethod = new ReflectionMethod(get_class($animal), 'likesHabitat');
        $reflectionMethod->setAccessible(true);
        $likeCount = 0;

        if ($reflectionMethod->invoke($animal, Zoo::HABITAT_ENCLOSURE)) {
            $likeCount++;
        }
        if ($reflectionMethod->invoke($animal, Zoo::HABITAT_POOL)) {
            $likeCount++;
        }
        if ($reflectionMethod->invoke($animal, Zoo::HABITAT_CAGE)) {
            $likeCount++;
        }

        return $likeCount == 1;
    }
}


