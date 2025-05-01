from testing.script import Rover

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


print("Test 3 - Move Rover against an obstacle")
obstacles = {(1,0)}
r = Rover(1,1,'S')
result = r.execute_collection_commands('F',obstacles, 3)
print(result)  

# Expected output
# (1, 1, 'S', True, {(1,0)} )
# Safe position X, Safe position Y, Final Direction, Aborted ?, Obstacles set


print("Test 4 - Rover hits obstacle after several turns & moves")
obstacles = {(5, 0)}
r = Rover(1, 3, 'E')
result = r.execute_collection_commands('FFRFFLFFRF', obstacles, 6)
print(result)

# Expected output
# (5, 1, 'S', True, {(5, 0)})
# Safe position X, Safe position Y, Final Direction, Aborted ?, Obstacles set


print("Test 5 - Full run with no abort")
obstacles = {(0, 2), (2, 3)}
r = Rover(1, 1, 'N')
result = r.execute_collection_commands('FRFFLFFRF', obstacles, 5)
print(result)

# Expected output
# (4, 4, 'E', False, None)
# Safe position X, Safe position Y, Final Direction, Aborted ?, Obstacles set
