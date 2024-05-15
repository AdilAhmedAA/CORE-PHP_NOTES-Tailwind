<?php 

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/' => 'controllers/app.php',
    '/add-notes' => 'controllers/add-notes.php',
];

if (array_key_exists($uri, $routes)) {
    require $routes[$uri];
}else {
    http_response_code(404);
    die();
}