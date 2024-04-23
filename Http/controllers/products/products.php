<?
use Core\App;
$db = App::resolve('Core\Database');
//dd($params['category']);
$products = $db->query('SELECT products.*, categories.name AS category_name, categories.text FROM products LEFT JOIN categories ON categories.category_id = products.category WHERE categories.slug = :slug AND status = "Online"', 
                    [
                        'slug' => $params['category']
                    ])->findAllOrFail();

$categories = $db->query('SELECT category_id, name, slug FROM categories')->get();

view('products/products', [
    'heading' => $products[0]['category_name'],
    'heading_info' => $db->totlaRows() . ' produse în total',
    'products' => $products,
    'title' => 'Shop - ' . $products[0]['category_name'] . ' - Tudor Halațiu',
    'description' => $products[0]['text'],
    'categories' => $categories,
    'current_category' => $params['category']
]);