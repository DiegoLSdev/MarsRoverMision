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

    function move_forward(array $obstacles, int $grid_size) : bool {
        // Using arrays as maps -> source : https://www.php.net/manual/en/language.types.array.php#language.types.array.syntax
        $vectors = [
            'N'=> [0, 1],
            'E'=> [1, 0],
            'S'=> [0, -1],
            'W'=> [-1, 0],
        ];
        // Current direction vector
        $movement = $vectors[$this->direction];

        // New position after the move
        $new_x = $this-> x + $movement[0];
        $new_y = $this-> y + $movement[1];

        # We could assing directly the new position to $this-> x and $this-> y but we have to check two things first
        # Remember! : we've been told how expensive Rovers are.

        // Check if the new position move is going to be inside the grid limits
        if (!($new_x >= 0 && $new_x < $grid_size) || !($new_y >= 0 && $new_y < $grid_size)) {
            return false;
        }
        // Check if there is an obstacle in the new position. -> source : https://www.php.net/manual/en/function.in-array.php
        if (in_array([$new_x, $new_y], $obstacles, true)){
            return false;
        }

        // Update position
        $this->x = $new_x;
        $this->y = $new_y;
        
        return true;
        
    }
}



