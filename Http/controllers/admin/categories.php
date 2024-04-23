<?
use Core\App;

$db = App::resolve('Core\Database');

$categories = $db->query('SELECT * FROM categories')->get();
view('admin/categories', [
    'heading' => 'Categorii produse',
    'heading_info' => 'Administrare categorii produse',
    'categories' => $categories
]);