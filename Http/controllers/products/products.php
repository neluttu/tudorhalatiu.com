<?
use Core\App;
$db = App::resolve('Core\Database');
//dd($params['category']);
$products = $db->query('SELECT products.*, categories.name AS category_name FROM products LEFT JOIN categories ON categories.category_id = products.category WHERE categories.slug = :slug AND status = "Online"', 
                    [
                        'slug' => $params['category']
                    ])->findAllOrFail();

view('products/products', [
    'heading' => $products[0]['category_name'],
    'products' => $products,
    'title' => $products[0]['category_name']
]);
?>