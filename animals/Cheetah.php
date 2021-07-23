<?php

class Cheetah extends Animal {

    /**
     * @return string
     */
    public function __toString(): string
    {
        return 'Cheetah';
    }

    /**
     * @return String
     */
    public function playInHabitat(): String {
        return "{$this->name} runs around the enclosure";
    }

    /**
     * @param $habitat
     * @return bool
     */
    protected function likesHabitat($habitat): bool
    {
        return $habitat == Zoo::HABITAT_ENCLOSURE;
    }
}
