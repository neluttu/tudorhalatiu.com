<?
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$routes = $db->query("SELECT * FROM routes ORDER BY uri ASC")->get();

view('admin/routes', [
    'heading' => 'Router pagini',
    'heading_info' => 'Administrează rutele siteului',
    'routes' => $routes,
]);