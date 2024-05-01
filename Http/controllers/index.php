<?
use Core\App;
$db = App::resolve('Core\Database');

$products = $db->query('SELECT products.*, categories.name AS category_name, categories.slug AS category_slug FROM products LEFT JOIN categories ON categories.category_id = products.category ORDER BY RAND() LIMIT 8')->get();

view('index', [
    'products' => $products,
    'title' => 'Tudor Halațiu - creator de modă - magazin online haine',
    'description' => 'Stralucirea ta este la un click distanta. Descopera creatiile de lux semnate Tudor Halatiu, dar si reducerile sezoniere'
]);