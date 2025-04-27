DIRECTIONS = ["N","E","S","W"]

class Rover :
    def __init__(self, x:int, y:int, direction:str):
        self.x = x
        self.y = y
        self.direction = direction