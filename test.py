from script import Rover

print("Test 1 - Turn left & Turn Right")

r = Rover(0,0,'N')

r.turn_right()
print(r.direction) # Expected output : "E"

r.turn_right()
print(r.direction) # Expected output : "S"