<?
use Core\App;

$db = App::resolve('Core\Database');

$product = $db->query('SELECT id, products.name, products.slug, category, discount, sizes, price, excerpt, description, status, stock, categories.name AS category_name FROM products LEFT JOIN categories ON categories.category_id = products.category WHERE id = :id', 
                    [
                        'id' => $params['id']
                    ])->findOrFail();

$categories = $db->query('SELECT category_id, name, slug FROM categories')->get();

$imagesFiles = glob(base_path('public/images/products/'.$product['id'].'/*.{jpg,png,avif,jpeg}'), GLOB_BRACE);
if($imagesFiles !== false and count($imagesFiles) > 0)
    foreach($imagesFiles as $key => $file) 
        $imagesFiles[$key] = str_replace(base_path(), '', $file);

// Get all product slugs
$productSlugs = $db->query('SELECT slug FROM products')->get();
foreach ($productSlugs as $slug)
    $slugs[] = $slug['slug'];

view('admin/product', [
    'heading' => $product['name'],
    'heading_info' => 'Produs din categoria ' .$product['category_name'],
    'product' => $product,
    'title' => $product['name'],
    'categories' => $categories,
    'sizes' => ['XS','S','M','L','XL','ONE SIZE'],
    'images' => $imagesFiles,
    'slugs' => $slugs
]);