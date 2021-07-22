<?php
require_once "Animal.php";

class Bird extends Animal {

    public function __toString(): String {
        return "Bird";
    }

    protected function likesHabitat($habitat): bool
    {
        return $habitat == Zoo::HABITAT_CAGE;
    }

    public function playInHabitat(): String {
        return "{$this->name} flutters";
    }
}
