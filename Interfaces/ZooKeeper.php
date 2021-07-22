<?php

interface ZooKeeper {

    /**
     * @param array $animals
     * @return array of array[Animals]
     */
    public function feedAnimals(array $animals): array;

    /**
     * @param array $animals
     * @return array of array[Animal]
     */
    public function herdAnimals(array $animals): array;
}
