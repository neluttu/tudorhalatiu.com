<?
use Core\App;
$db = App::resolve('Core\Database');

$products = $db->query('SELECT products.*, categories.name AS category_name, categories.slug AS category_slug FROM products LEFT JOIN categories ON categories.category_id = products.category ORDER BY RAND() LIMIT 8')->get();

view('index', [
    'products' => $products,
    'title' => 'Tudor Halațiu - creator de modă - magazin online',
    'description' => 'Descoperă colecția exclusivă Tudor Halațiu: top-uri elegante, rochii de seară, rochii de zi, jachete și paltoane deosebite, plus ediții limitate pentru un stil unic.'
]);