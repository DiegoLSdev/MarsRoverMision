from script import Rover

print("Test 1 - Turn left & Turn Right")

r = Rover(0,0,'N')

r.turn_right()
print(r.direction) # Expected output : "E"

r.turn_right()
print(r.direction) # Expected output : "S"

r.turn_left()
print(r.direction) # Expected output : "E"

r.turn_left()
print(r.direction) # Expected output : "N"

print("Test 2 - Move Rover outside the grid")
obstacles = {}
r = Rover(0,2,'N')
result = r.execute_collection_commands('F', obstacles, 3)
print(result) 

# Expected output
# (0, 2, 'N', True, None)
# Safe position X, Safe position Y, Final Direction, Aborted ?, Obstacles