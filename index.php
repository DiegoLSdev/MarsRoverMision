<?php 

// Class Rover -> source : https://www.php.net/manual/en/language.oop5.basic.php

class Rover
{
    private int $x;
    private int $y;
    private string  $direction;
    private const DIRECTIONS = ["N", "E", "S", "W"];

    // Methods -> source : https://www.php.net/manual/en/language.oop5.decon.php
    function __construct(int $x, int $y, string $direction) {
        $this -> x = $x;
        $this -> y = $y;
        $this -> direction = $direction;
    }

    // Turn left -> source : https://www.php.net/manual/en/function.array-search.php
    function turn_left() {
        # Find current index inside directions
        $current_index = array_search($this->direction, self::DIRECTIONS);

        # Find new index inside directions
        $new_index = $current_index - 1;

        # Logic to get new direction when negative index is found.
        if ($new_index < 0) {
            $new_index = count(self::DIRECTIONS) -1;
        }
       
        # Update DIRECTION
        $this->direction = self::DIRECTIONS[$new_index];
    }
    function turn_right() {
        $current_index = array_search($this->direction, self::DIRECTIONS);
        $new_index = $current_index + 1;
        if ($new_index >= count(self::DIRECTIONS)) {
            $new_index = 0;
        }
        $this->direction = self::DIRECTIONS[$new_index];

    }

}



?>