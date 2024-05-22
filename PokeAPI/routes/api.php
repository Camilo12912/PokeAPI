<?php
require_once '../controllers/PokemonController.php';

$controller = new PokemonController();

$requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$endpoint = $requestUri[1] ?? '';
$id = $requestUri[2] ?? null;

header('Content-Type: application/json');

switch ($endpoint) {
    case 'pokemons':
        if ($id) {
            $controller->getPokemonById($id);
        } else {
            $controller->getPokemons();
        }
        break;
    case 'trainers':
        if ($id) {
            $controller->getTrainerById($id);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Trainer ID is required']);
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(['message' => 'Endpoint not found']);
        break;
}
