<?php

abstract class Animal {

    public $name;
    private $isFed = false;
    private $habitat;
    private $hasEscaped = false;
    private $canPlay = true;

    /**
     * Animal constructor. Name and the current habitat it resides in.
     * @param $name
     * @param $habitat
     */
    public function __construct($name, $habitat) {
        $this->name = $name;
        $this->moveToHabitat($habitat)
            ->feed();
    }

    /**
     * Change the habitat
     * Also an example of chaining method calls. That's what the return $this is for
     * @param $habitat
     * @return $this
     */
    final public function moveToHabitat($habitat): Animal {
       $this->habitat = $habitat;
       return $this;
    }

    /**
     * Changes is feed to true
     * Also an example of chaining method calls. That's what the return $this is for
     * @return $this
     */
    final public function feed(): Animal {
       $this->isFed = true;
       return $this;
    }

    /**
     * Access isFed
     * @return bool
     */
    final public function isHungry(): bool {
        return !$this->isFed;
    }

    /**
     * Test if the animal is fed, like their habitat, and can play in it
     * @return bool
     */
    final public function isHappy(): bool {
        return $this->isFed && $this->likesHabitat($this->habitat) && $this->canPlay;
    }

    /**
     * Called by Zoo->processDay()
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
     * This is call when we want to know what type of animal it is.
     * It should be a human readable
     * It does not have to conform to PHP class name restrictions. i.e Blue Moose or Peregrine Falcon
     * @TODO override with a better name. Or your nephew not know what type of animal the child class is
     * @return string
     */
    public function __toString(): string
    {
        return '<MISSING>';
    }


    /**
     * Should return a sentence (without punctuation) of the animal playing in the habitat
     * Something like: "{$this->name} flutters his wings"
     * or: "{$this->name} runs around the enclosure"
     * @TODO override with a better action and don't include the canPlay or you nephew not see a happy animal
     * @return String
     */
    public function playInHabitat(): String {
        $this->canPlay = false;
        return "{$this->name} is dead and does nothing";
    }


    /**
     * Dont overthink this one.
     * @TODO override with a correct implementation. You can't just return true!!!
     * @param $habitat
     * @return bool
     */
    abstract protected function likesHabitat($habitat): bool;

}
