<?php

require_once __DIR__ . '/index.php';

function dumpResult(array $r)
{
    // nicely format the tuple
    echo "("
        . $r[0] . ", "
        . $r[1] . ", '"
        . $r[2] . "', "
        . ($r[3] ? 'True' : 'False') . ", "
        . (is_array($r[4]) ? "['" . implode("','", $r[4]) . "']" : 'null')
        . ")\n";
}


// ---- Test 1: Turn left & right ----
echo "Test 1 - Turn left & Turn Right\n";
$r = new Rover(0, 0, 'N');
$r->turn_right();
echo $r->getDirection() . "\n"; // E
$r->turn_right();
echo $r->getDirection() . "\n"; // S
$r->turn_left();
echo $r->getDirection() . "\n"; // E
$r->turn_left();
echo $r->getDirection() . "\n"; // N


echo "\nTest 2 - Move Rover outside the grid\n";
$obstacles = [];
$r = new Rover(0, 2, 'N');
$res = $r->execute_collection_commands('F', $obstacles, 3);
var_export($res);
// Expect (0,2,'N',True,null)


echo "\nTest 3 - Move Rover against an obstacle\n";
$obstacles = [[1, 0]];
$r = new Rover(1, 1, 'S');
$res = $r->execute_collection_commands('F', $obstacles, 3);
var_export($res);
// Expect (1,1,'S',True,['1','0'])


echo "\nTest 4 - Rover hits obstacle after several turns & moves\n";
$obstacles = [[5, 0]];
$r = new Rover(1, 3, 'E');
$res = $r->execute_collection_commands('FFRFFLFFRF', $obstacles, 6);
var_export($res);
// Expect (5,1,'S',True,['5','0'])


echo "\nTest 5 - Full run with no abort\n";
$obstacles = [[0, 2], [2, 3]];
$r = new Rover(1, 1, 'N');
$res = $r->execute_collection_commands('FRFFLFFRF', $obstacles, 5);
var_export($res);
// Expect (4,4,'E',False,null)
