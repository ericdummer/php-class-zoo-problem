<?php

class Cheetah extends Animal {

    public function __toString(): string
    {
        return 'Cheetah';
    }

    public function playInHabitat(): String {
        return "{$this->name} runs around the enclosure";
    }

    protected function likesHabitat($habitat): bool
    {
        return $habitat == Zoo::HABITAT_ENCLOSURE;
    }
}
