<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_set_cookie_params(["SameSite" => "Strict"]);
session_set_cookie_params(["Secure" => "true"]);

$session_name = '__Secure-' . session_name();
session_name($session_name);
session_start();

use Core\App;
use Core\Database;

const BASE_PATH = __DIR__ . '/';

require (BASE_PATH . 'vendor/autoload.php');
require BASE_PATH . 'Core/functions.php';
Core\Lang::loadLanguage();

require base_path('bootstrap.php');

// Setup router.
$router = new \Core\Router;
$db = App::resolve(Database::class)->query("SELECT * FROM routes ORDER BY page ASC")->get();

foreach ($db as $route) {
    $method = $route['method'];
    if(empty($route['middleware']))
        $router->$method('/{lang}' . $route['uri'], $route['controller']);
    else 
        $router->$method('/{lang}' . $route['uri'], $route['controller'])->only($route['middleware'], $route['middleware_redirect']);
}
$router->route();

// unflash session variables
Core\Session::unflash();