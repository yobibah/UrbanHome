<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../routes/routers.php';


$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Routage dynamique : /controller/action/param1/param2
$segments = explode('/', $uri);
$controllerName = !empty($segments[0]) ? ucfirst($segments[0]) . 'Controllers' : 'HomeControllers';
$action = isset($segments[1]) && $segments[1] !== '' ? $segments[1] : 'index';
$params = array_slice($segments, 2);

$controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    if (class_exists($controllerName)) {
        $controller = new $controllerName();
        if (method_exists($controller, $action)) {
            call_user_func_array([$controller, $action], $params);
        } else {
            http_response_code(404);
            echo "Méthode '$action' non trouvée dans $controllerName.";
        }
    } else {
        http_response_code(404);
        echo "Contrôleur '$controllerName' non trouvé.";
    }
} else {
    // Contrôleur par défaut : HomeControllers@index
    require_once __DIR__ . '/../controllers/HomeControllers.php';
    $controller = new HomeControllers();
    $controller->index();
}
