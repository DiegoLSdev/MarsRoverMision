<?php 

// Class Rover -> source : https://www.php.net/manual/en/language.oop5.basic.php

class Rover
{
    private const DIRECTIONS = ["N","E","S","W"];
    private int $x;
    private int $y;
    private string  $direction;

    // Methods -> source : https://www.php.net/manual/en/language.oop5.decon.php
    function __construct(int $x, int $y, string $direction) {
        $this -> x = $x;
        $this -> y = $y;
        $this -> direction = $direction;
    }

    // Turn left -> source : https://www.php.net/manual/en/function.array-search.php
    function turn_left() {
        # Find current index inside DIRECTIONS
        # Find the new index inside DIRECTIONS
        # Update DIRECTION
    }
    function turn_right() {
        # Find current index inside DIRECTIONS
        # Find the new index inside DIRECTIONS
        # Update DIRECTION
    }

}



?>