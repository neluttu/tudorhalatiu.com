<?
use Core\App;
$db = App::resolve('Core\Database');

$products = $db->query('SELECT products.*, categories.name AS category_name FROM products LEFT JOIN categories ON categories.category_id = products.category ORDER BY RAND() LIMIT 8')->get();

view('index', [
    'title' => Core\Lang::text('header.title'),
    'products' => $products
]);