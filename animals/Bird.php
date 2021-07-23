<?php
require_once "Animal.php";

class Bird extends Animal {

    /**
     * @return String
     */
    public function __toString(): String {
        return "Bird";
    }

    /**
     * @param $habitat
     * @return bool
     */
    protected function likesHabitat($habitat): bool
    {
        return $habitat == Zoo::HABITAT_CAGE;
    }

    /**
     * @return String
     */
    public function playInHabitat(): String {
        return "{$this->name} flutters";
    }
}
