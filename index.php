<?php

include __DIR__ . '/vendor/autoload.php';

ini_set('display_errors', config('app.debug'));

session_start();                //starting session

use Core\Database;                                          // Getting all necessary classes
use Core\Managers\FlashMessageManager\FlashMessage;
use Core\Managers\SessionManager\SessionManager;



(new Database(                                          //Creating new Database connection
    config('database.host'),
    config('database.username'),
    config('database.password'),
    config('database.database')
));

$sessionManager = SessionManager::get();            // initializing new sessionManage for managing session time
if ($sessionManager->hasExpired()) {
    $sessionManager->invalidate();
}

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $router) {  // Medoo dispathcher
    $namespace = "\\App\\Controllers\\";
    $router->get('/', $namespace . 'HomeController@home');
    $router->get('/auth/login', $namespace . 'Auth\LoginController@showLoginForm');
    $router->post('/auth/login', $namespace . 'Auth\LoginController@login');

    $router->post('/auth/logout', $namespace . 'Auth\LogoutController@logout');

    $router->get('/auth/reset', $namespace . 'PaswordResetController@showResetForm');
    $router->put('/auth/reset', $namespace . 'PaswordResetController@resetLink');
    $router->get('/auth/reset/{token}', $namespace . 'PaswordResetController@passwordChangeForm');
    $router->put('/auth/reset/{token}', $namespace . 'PaswordResetController@resetPassword');

    $router->get('/auth/signup', $namespace . 'SignUpController@showSignUpForm');
    $router->post('/auth/signup', $namespace . 'SignUpController@signUp');

});


(new FlashMessage());       // initializing FlashManager for managing error messages

// Fetch method and URI from somewhere

$httpMethod = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controller, $method] = explode('@', $handler); // getting class and method

        (new $controller)->$method($vars);
        break;
}
if ($httpMethod === 'GET') {
    flashMessage()->clear();
}


$sessionManager->update(); // updating session time
