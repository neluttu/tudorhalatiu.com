<?
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$settings = $db->query("SELECT * FROM config")->get();

view('admin/settings', [
    'heading' => 'Setări magazin online',
    'heading_info' => 'Administrează setările de bază',
    'settings' => $settings,
]);