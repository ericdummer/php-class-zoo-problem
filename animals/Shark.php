<?php

require_once "animals/Animal.php";

class Shark extends Animal {

    /**
     * @param $habitat
     * @return bool
     */
    protected function likesHabitat($habitat): bool
    {
        return $habitat == Zoo::HABITAT_POOL;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return 'Shark';
    }

    /**
     * @return String
     */
    public function playInHabitat(): String {
        return "{$this->name} flips his fins";
    }
}
