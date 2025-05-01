Hello team, 

I'd like to share with you my approach to the problem. On this page you'll find the steps I followed, my ideas and the desicions made to develop the solution.

## Index

🐍 [Python script](https://github.com/DiegoLSdev/MarsRoverMision/blob/main/script.py)

🐍 [Python test](https://github.com/DiegoLSdev/MarsRoverMision/blob/main/test.php)

🐘 [PHP script](https://github.com/DiegoLSdev/MarsRoverMision/blob/main/index.php)

🐘 [PHP test](https://github.com/DiegoLSdev/MarsRoverMision/blob/main/test.php)

[API](##API)



## Choosing a programming language

I usually do Advent of Code and other algorithmic challengesm and I've always used Python, since it was the first language I learned along with Javascript, and I find it easier to apply to these kinds of problems, so first I'm going to implement the logic in Python.

After  implemented a solution in Python,  which allowed me to focus on the problem and its alorithm logic. That's why you will see the logic construction made using Python.

I have now made the solution using PHP, since its the primary language for the role. [Here is the PHP code](https://github.com/DiegoLSdev/MarsRoverMision/blob/main/index.php)

You'll notice in that code that I've included links to the PHP documentation to highligh that I'm porting the logic from Python to PHP.

I wouldn't normally include so many comments, because clean code is important, but I chose to document the entire process I followed to complete the work.

# LOGIC

## Planet

Bidimensional grid, which size is `200 × 200`
this is how I imagine the planet:

![Planet](./public/Planet.png)

## Rover

I have think about this and the best option as far as I know is to create a class with attributes and methods.

### Attributes

Rover is going to have an initial starting point (x,y)
Rover also need a direction (N,S,E,W)

```python
class Rover:_
    def __init__(self, x:int, y:int, direction:str):
```
```x:int``` and ```y:int``` are the coordinates of the initial position.

Regarding the initial direction of the Rover, I am planning to use an array ```DIRECTIONS = ["N","S","E","W"] ``` where each index is going to be associated with the Strig inside its index. 

I will try to explain myself better: If Rover turns right (90º) we will "jump" one index position, like a cycle of steps.
But to make it possible we have to change the order of the items inside ```DIRECTIONS``` to ```DIRECTIONS = ["N","E","S","W"]```.

If we are facing Nord ("N") -> Index 0 and turn right 90 degrees we are going to be heading to East ("E") -> Index 1.

If we turn again 90 degrees to the right, South ("S")-> Index 2 , and then West ("W")-> Index 3.

But this is only possible  using ("N", "E", "S", "W"). 

I will need to perform some logic when the turn is to the left because we will "jump" from Nord ("N") -> Index 0 to last index of the array West ("W")-> Index 3

![Directions modified](./public/Directions_right.png)

The given example it's not oging to allow this behaviour

![Directions modified](./public/Directions_wrong.png)

### Methods

Now it's time to think about the functions to turn left and right, but also to move forward. There is no need to move backwards because we can turn 2 times lef or right, and move forward.


```python
def turn_left(self)
```
Find current direction of Rover.

Substract 1 to the index of directions.

Assign the index of the new direction.

<br>
<br>

```python
def turn_right(self)
```

Find current direction of Rover.

Add 1 to the index of directions.

Assign the index of the new direction.

<br>
<br>


```python
def move_forward(self, obstacles:set, grid_size:int) -> bool
```
**Args:**

obstacles: set of coordinates -> {(0,2),(1,3)}

grid_size:  integer representing the square grid

**Returns:**

True: If the move was successful.

False: If the move would go off-grid or hit an obstacle.

<br>
<br>
 
```python
def execute_collection_commands(self, commands:str, obstacles:set, grid_size:int ) -> tuple[int, int, str, bool, tuple[int, int] |  None]:
```

**Args:**

commands : string of instructions -> ```"FFRFLF"```.

obstacles : set of coordinates -> ```{(0,2),(1,3)}```.

grid_size:  integer representing the square grid ```200```.

**Returns:**

```x``` : integer representing final X Axis position.

```y``` : integer representing final Y Axis position.

direction : string to know the Final direction of Rover -> ```"N"``` (Nord).

aborted? : boolean that will output ```True``` if execution was aborted.

obstacle_position: It can be a tuple or a ```None``` value. That's why:
- If aborted move by obstacle ->  the obstacle by ```tuple[int,int]```.
- If aborted by grid limits -> ```None``` will be displayed instead.
- If not aborted : Also will return ```None```.


## API

My plan is to create pure php api that receive JSON petitions and returns the Rover position (status)

After that I'm going to create a front end using an SPA with Vue.js

- Frontend will display the grid and locate rover with obstacles.
- User will be able to send commands and parameters ( "FFRRLFRL" , Grid Size = 200, initial position = (50,32)...)
- This command will call the API and execute the commands.

### API Design

- POST -> /api/rover/start
- POST -> /api/rover/execute_commands
- GET  -> /api/rover/status

I would add another route that will reset the position, to be able to start again when the path is not valid.
- POST -> /api/rover/restart

My concern now is to keep track of the rover moves and I think I will keep it simple with logs inside json file.

The new structure for the project will have two different php files. ![Folder structure using MD](https://dev.to/your-ehsan/how-to-easily-create-folder-structure-in-readme-markdown-with-two-simple-steps-3i42)

```bash
├─── rover-api
│    └─── Rover.php (Rover Class)
│    └─── index.php (Routes logic)
│    └─── reports.json (Storage)
```

After the backend logic is set in [index.php](https://github.com/DiegoLSdev/MarsRoverMision/blob/main/rover-api/index.php), I will test the endpooints using Thunder Client.

First of all run the php file:
```php -S localhost:8000 -t rover-api```

I've already tested all endpoints and will proceed with the graphic implementation