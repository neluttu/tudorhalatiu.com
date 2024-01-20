<?
use Core\App;

$db = App::resolve('Core\Database');

$product = $db->query('SELECT id, products.name, sizes, price, excerpt, description, status, categories.name AS category_name FROM products LEFT JOIN categories ON categories.category_id = products.category WHERE id = :id AND status = "Online"', 
                    [
                        'id' => $params['id']
                    ])->findOrFail();
                    
view('products/view', [
    'heading' => $product['name'],
    'heading_info' => 'Produs din categoria ' .$product['category_name'],
    'product' => $product,
    'title' => $product['name']
]);