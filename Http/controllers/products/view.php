<?
use Core\App;

$db = App::resolve('Core\Database');

$product = $db->query('SELECT * FROM products WHERE id = :id AND status = "Online"', 
                    [
                        'id' => $params['id']
                    ])->findOrFail();
                    
view('products/view', [
    'heading' => $product['name'],
    'product' => $product,
    'title' => $product['name']
]);
?>