<?
use Core\App;

$db = App::resolve('Core\Database');

$product = $db->query('SELECT * FROM products WHERE id = ' . $params['id'])->findOrFail();

view('products/product', [
    'heading' => 'Product info',
    'params' => $params,
    'product' => $product
]);
?>