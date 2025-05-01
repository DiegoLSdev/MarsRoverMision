<?php

# Declare Rover.php

declare(strict_types=1);
require_once 'Rover.php';

# Jsoon file persist


# Read route and method

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

# Conditional logic to act according the action (route)
switch ("$method $url") {
    #  POST -> api/rover/start
    case 'POST /api/rover/start':
        # Get data
        $data = json_decode(file_get_contents('php://input'),true); 
        # Get status
        $state =  [
            "x" => $data['x'],
            "y" => $data['y'],
            "direction" => $data['direction'],
            "gridSize" => $data['gridSize'],
            "obstacles" => $data['obstacles'],
        ];

    #  POST -> api/rover/execute_commands
    #  GET  -> api/rover/status
    #  POST -> api/rover/restart
}



?>