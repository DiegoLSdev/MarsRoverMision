<?php

# Declare Rover.php

declare(strict_types=1);
require_once 'Rover.php';

# Jsoon file persist

function load_state(): array {
    if (file_exists('reports.json')) {
        return json_decode(file_get_contents('reports.json'), true);
    }
    return [];
}

function save_state(array $state): void {
    file_put_contents('reports.json', json_encode($state));
}

# Read route and method

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

# Conditional logic to act according the action (route)
switch ("$method $url") {

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

        # Save the status in the json file
        save_state($state);

        # Return the status to the backend
        echo json_encode(['Success' => true]);

        break;

    case 'POST /api/rover/execute_commands' : 
        # Get commands
        $commands = json_decode(file_get_contents("php://input"),true);
        
        # Get the actual status (read the json file)
        $status = json_decode(file_get_contents('reports.json'), true);

        # Pass the coordinates and direction to the class
        $rover = new Rover(
            $status['x'],
            $status['y'],
            $status['direction']
        );

        # Execute the commands and get the new coordinates and direction
        [$x, $y, $direction, $aborted, $obstacle] = 
        $rover -> execute_collection_commands(
            $payload['commands'],
            $status['obstacles'],
            $status['gridSize']
        );

        # If the collections of commands DID NOT ABORT, asign new coordinates and direction
        if (!$aborted) :
            $status['x'] = $x;
            $status['y'] = $y;
            $status['direction'] = $direction;

        # Save the new status in the json file
            file_put_contents('reports.json', json_encode($status));

        # Prepare the response for the backend
        $response = [
            'x' => $x ,
            'y' => $y,
            'direction' => $direction,
            'aborted' => $aborted
        ];
        endif;
        # If the collections of commands DID ABORT due to obstacle : Addnew coordinates of the obstacle
         if ($obstacle !== null) :
            $response['obstacle'] = $obstacle;
        endif;
        # Return the response to the backend
        echo json_encode($response);
        break;
    case 'GET /api/rover/status':
        # Get the status from the json file
        $status = json_decode(file_get_contents('reports.json'), true);

        # Return the status to the backend
        echo json_encode([
            'x' => $status['x'] ?? null,
            'y' => $status['y'] ?? null,
            'direction' => $status['direction'] ?? null,
        ]);

        break;
    
    case 'POST /api/rover/restart':
        # Get the status from the json file
        $status = json_decode(file_get_contents('reports.json'), true);

        # Return the status to the backend
        echo json_encode([
            'x' => $status['x'] ?? null,
            'y' => $status['y'] ?? null,
            'direction' => $status['direction'] ?? null,
        ]);
        break;
} 
