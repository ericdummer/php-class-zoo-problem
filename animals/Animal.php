<?php

abstract class Animal {

    public $name;
    public $habitat;
    public $isFed = false;
    private $hasEscaped = false;
    private $canPlay = true;

    public function __construct($name, $habitat) {
        $this->name = $name;
        $this->moveToHabitat($habitat)
            ->feed();
    }

    /**
     * @param $habitat
     * @return $this
     */
    final public function moveToHabitat($habitat): Animal {
       $this->habitat = $habitat;
       return $this;
    }

    /**
     * @return $this
     */
    final public function feed(): Animal {
       $this->isFed = true;
       return $this;
    }

    final public function isHungry(): bool {
        return !$this->isFed;
    }

    /**
     * @return bool
     */
    final public function isHappy(): bool {
        return $this->isFed && $this->likesHabitat($this->habitat) && $this->canPlay;
    }

    /**
     * @return $this
     */
    final public function tryToEscape() {
        if (!$this->likesHabitat($this->habitat)) {
            $this->hasEscaped = true;
        }
        return $this;
    }

    /**
     * @return bool
     */
    final public function hasEscaped(): bool {
        return $this->hasEscaped;
    }

    /**
     * @TODO override with a better name. Or your nephew not know what type of animal the child class is
     * @return string
     */
    public function __toString(): string
    {
        return '<MISSING>';
    }


    /**
     * @TODO override with a better action and don't include the canPlay or you nephew not see a happy animal
     * @return String
     */
    public function playInHabitat(): String {
        $this->canPlay = false;
        return "{$this->name} is dead and does nothing";
    }


    /**
     * @TODO override with a correct implementation. You can't just return true!!!
     * @param $habitat
     * @return bool
     */
    abstract protected function likesHabitat($habitat): bool;

}
