<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class)->query("SELECT * FROM routes ORDER BY id, page ASC")->get();

foreach ($db as $route) {
    $method = $route['method'];
    if (empty($route['middleware']))
        $router->$method('/{lang}' . $route['uri'], $route['controller']);
    else
        $router->$method('/{lang}' . $route['uri'], $route['controller'])->only($route['middleware'], $route['middleware_redirect']);
}