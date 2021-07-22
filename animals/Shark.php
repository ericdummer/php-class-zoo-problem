<?php

require_once "animals/Shark.php";

class Shark extends Animal {

    protected function likesHabitat($habitat): bool
    {
        return $habitat == Zoo::HABITAT_POOL;
    }

    public function __toString(): string
    {
        return 'Shark';
    }

    public function playInHabitat(): String {
        return "{$this->name} flips his fins";
    }
}
