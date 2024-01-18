<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
const BASE_PATH = __DIR__ . '/';
require (BASE_PATH . 'vendor/autoload.php');
require BASE_PATH . 'Core/functions.php';
Core\Lang::loadLanguage();
require base_path('bootstrap.php');

// Setup router.
$router = new \Core\Router;
require base_path('routes.php');

$router->route();


Core\Session::unflash();