<?php

    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }


$routes = [
    '/add-product' => 'ProductController@addProduct',
    '/products' => 'ProductController@getProducts',
    '/products/{id}' => 'ProductController@showProduct',
    '/add-product-types' => 'ProductTypeController@addProductTypes',
    '/product-types' => 'ProductTypeController@getProductTypes',
    '/product-types/{id}' => 'ProductTypeController@showProductType',
    '/sales' => 'SaleController@getSales',
    '/new-sale' => 'SaleController@newSale'
];


$path = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if (array_key_exists($path, $routes)) {
    $controllerAction = $routes[$path];
    [$controllerName, $action] = explode('@', $controllerAction);

    $controllerFile = __DIR__ . '/Controller/' . $controllerName . '.php';

    if (file_exists($controllerFile)) {
        require_once $controllerFile;

        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            if (method_exists($controller, $action)) {
                $controller->$action();
                exit;
            }
        }
    }
} else {

    $routeParams = [];

    foreach ($routes as $route => $controllerAction) {
        $routePattern = str_replace('/', '\/', $route);
        $routePattern = preg_replace('/\{\w+\}/', '(\w+)', $routePattern);
        $routePattern = '/^' . $routePattern . '$/';

        if (preg_match($routePattern, $path, $matches)) {
            preg_match_all('/\{(\w+)\}/', $route, $paramNames);

            foreach ($paramNames[1] as $index => $paramName) {
                $routeParams[$paramName] = $matches[$index + 1];
            }

            $controllerAction = $controllerAction;
            [$controllerName, $action] = explode('@', $controllerAction);

            $controllerFile = __DIR__ . '/Controller/' . $controllerName . '.php';

            if (file_exists($controllerFile)) {
                require_once $controllerFile;

                if (class_exists($controllerName)) {
                    $controller = new $controllerName();

                    if (method_exists($controller, $action)) {
                        $controller->$action($routeParams["id"]);
                        exit;
                    }
                }
            }
        }
    }
}

http_response_code(404);
echo "Route not found.";

?>
