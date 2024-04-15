<?
use Core\App;
$db = App::resolve('Core\Database');
$categories = $db->query('SELECT category_id, name, slug FROM categories')->get();
view('admin/product-create', [
    'heading' => 'Adaugă produs',
    'heading_info' => '',
    'categories' => $categories,
    'sizes' => ['XS','S','M','L','XL','ONE SIZE']
]);