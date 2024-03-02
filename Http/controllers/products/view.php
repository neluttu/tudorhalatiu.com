<?
use Core\App;
use Core\ProductViewCounter;

$db = App::resolve('Core\Database');

$productViewCounter = new ProductViewCounter();
$productViewCounter->incrementProductView($params['id']); 

$product = $db->query('SELECT id, products.name, category, sizes, price, excerpt, description, status, categories.name AS category_name, views FROM products LEFT JOIN categories ON categories.category_id = products.category LEFT JOIN product_views ON product_views.product_id = products.id WHERE id = :id AND status = "Online"', 
                    [
                        'id' => $params['id']
                    ])->findOrFail();


$categories = $db->query('SELECT category_id, name, slug FROM categories')->get();

view('products/view', [
    'heading' => $product['name'],
    'heading_info' => 'Produs din categoria ' .$product['category_name'],
    'product' => $product,
    'title' => $product['name'],
    'categories' => $categories,
    'views' => $product['views']
]);