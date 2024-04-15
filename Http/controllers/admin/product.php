<?
use Core\App;

$db = App::resolve('Core\Database');

$product = $db->query('SELECT id, products.name, category, sizes, price, excerpt, description, status, stock, categories.name AS category_name FROM products LEFT JOIN categories ON categories.category_id = products.category WHERE id = :id', 
                    [
                        'id' => $params['id']
                    ])->findOrFail();

$categories = $db->query('SELECT category_id, name, slug FROM categories')->get();

$imagesFiles = glob(base_path('public/images/products/'.$product['id'].'/*.{jpg,png}'), GLOB_BRACE);
if($imagesFiles !== false and count($imagesFiles) > 0)
    foreach($imagesFiles as $key => $file) 
        $imagesFiles[$key] = str_replace(base_path(), '', $file);

view('admin/product', [
    'heading' => $product['name'],
    'heading_info' => 'Produs din categoria ' .$product['category_name'],
    'product' => $product,
    'title' => $product['name'],
    'categories' => $categories,
    'sizes' => ['XS','S','M','L','XL','ONE SIZE'],
    'images' => $imagesFiles
]);