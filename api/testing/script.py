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

    def move_forward(self, obstacles:set, grid_size:int) -> bool:

        # Each direction has to be assigned to a real vector.
        vectors = {
            'N': (0,1),  #  ↑
            'E': (1,0),  #  →
            'S': (0,-1), #  ↓
            'W': (-1,0), #  ←
        }

        current_direction_key = self.direction # Store the actual direction of Rover
        movement = vectors[current_direction_key] # Store the vector current direction

        # Expected movement of each Axis
        x = movement[0]
        y = movement[1]

        # New position after the move
        new_x = self.x + x
        new_y = self.y + y

        # We could assing directly the new position to self.x and self.y but we have to check to things first
        # Remember! : we've been told how expensive Rovers are. 

        # Check if the new position move is going to be inside the grid limits
        if not(0 <= new_x < grid_size) or not (0 < new_y < grid_size):
            return False
        # Check if there is an obstacle in the new position.
        if (new_x, new_y) in obstacles : 
            return False
        
        # Movement action
        self.x = new_x
        self.y = new_y

        return True        
    
    def execute_collection_commands(self, commands:str, obstacles:set, grid_size:int ) -> tuple[int, int, str, bool, tuple[int, int] |  None]:
        for command in commands : 
            if command == 'L' :
                self.turn_left()
            elif command == 'R':
                self.turn_right()
            elif command == "F":

                vectors = {
                'N':(0,1),  #  ↑ 
                'E':(1,0),  #  → 
                'S':(0,-1), #  ↓ 
                'W':(-1,0), #  ←
                }

                # Calculate the new step position without Rover move
                x, y = vectors[self.direction]

                # Target positions
                tx,ty  = [self.x + x , self.y + y]
                target_position = (x + self.x, y + self.y )

                # If target is out of the grid, just abort and inform there is no path
                if not (0 <= tx < grid_size) or not (0 <= ty < grid_size):
                    return self.x, self.y, self.direction, True, None

                # If the target position is an obstacle, abort and inform
                if (target_position) in obstacles :
                    return self.x, self.y, self.direction, True, target_position
                
                # In case there is a valid move,
                self.move_forward(obstacles, grid_size)
                
        return self.x, self.y, self.direction, False, None