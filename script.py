DIRECTIONS = ["N","E","S","W"]

class Rover :
    def __init__(self, x:int, y:int, direction:str):
        self.x = x
        self.y = y
        self.direction = direction

    def turn_left(self):
        current_direction_index = DIRECTIONS.index(self.direction)
        new_direction_index = current_direction_index - 1 # -1 because turn is to left

        # Logic to get new direction when negative index is found.
        if new_direction_index < 0 :
            new_direction_index = len(DIRECTIONS) - 1 # new_direction_index = 4 - 1 -> "W"

        new_direction = DIRECTIONS[new_direction_index]
        self.direction = new_direction

    def turn_right(self):
        current_direction_index = DIRECTIONS.index(self.direction)
        new_direction_index = current_direction_index + 1 # +1 because turn is to right

        # Logic to get new direction when index steps out the DIRECTIONS range
        if new_direction_index >= len(DIRECTIONS) :
            new_direction_index = 0 # new_direction_index = first position -> "N"

        new_direction = DIRECTIONS[new_direction_index]
        self.direction = new_direction