<?php

# Declare Rover.php
declare(strict_types=1);
require_once 'Rover.php';

# Set the header to allow CORS and JSON response
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

# Load the current state function
function load_state(): array {
    if (file_exists('reports.json')) {
        return json_decode(file_get_contents('reports.json'), true);
    }
    return [];
}

# Save the current state  function
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

        # Load status
        $status = load_state();

        # Get status
        $state =  [
            "x" => $data['x'],
            "y" => $data['y'],
            "direction" => $data['direction'],
            "gridSize" => $data['gridSize'],
            "obstacles" => $data['obstacles'],
        ];

        # Apend the log to the json file
        $log = $status['log'] ?? [];
        $log[] = [
            'x' => $data['x'],
            'y' => $data['y'],
            'direction' => $data['direction'],
            'gridSize' => $data['gridSize'],
            'obstacles' => $data['obstacles'],
        ];
        # Save the status in the json file
        save_state($state);

        # Return the status to the backend
        echo json_encode(['Success' => true]);

        break;

    case 'POST /api/rover/execute_commands':
            # Get the commands 
            $data     = json_decode(file_get_contents('php://input'), true);
            $commands = $data['commands'] ?? '';


            # Check the json logs content (status)
            $status = load_state();

            # Add the log to the json file
            $log = $status['log'] ?? [];
        
            # Check the rover status
            $rover = new Rover(
                $status['x'],
                $status['y'],
                $status['direction']
            );
        
            # Execute the commands
            [$x, $y, $direction, $aborted, $obstacle] =
                $rover->execute_collection_commands(
                    $commands,
                    $status['obstacles'],
                    $status['gridSize']
                );
        
            # Update the status only if it didn't abort
            if (!$aborted) {
                $status['x']         = $x;
                $status['y']         = $y;
                $status['direction'] = $direction;
                save_state($status);
            }
            
            # Return the status to the backend
            $response = compact('x','y','direction','aborted','obstacle');
            if ($obstacle !== null) {
                $response['obstacle'] = $obstacle;
            }

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
        # Get the data
        $status = [
            'x' => 0,
            'y' => 0,
            'direction' => 'N',
            'gridSize' => [200, 200],
            'obstacles' => [],
        ];
        # Apend log to the json file
        $log = $status['log'] ?? [];
        $log[] = [
            'x' => 0,
            'y' => 0,
            'direction' => 'N',
            'gridSize' => [200, 200],
            'obstacles' => [],
        ];

        # Save the status in the json file
        save_state($status);
        echo json_encode(['Success' => true]);
        break;
} 
