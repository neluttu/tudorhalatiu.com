<?
use Core\App;
use Core\ProductViewCounter;
use Core\SchemaGenerator;

$db = App::resolve('Core\Database');

// Check if is old URL with id from wrong Google indexed page.
if (isset($params['id']) && is_numeric($params['id']) && preg_match('/^\d{1,4}$/', $params['id'])) {
    $product = $db->query('SELECT id, products.slug, products.name, category, sizes, price, excerpt, description, status, categories.name AS category_name, categories.slug AS category_slug FROM products LEFT JOIN categories ON categories.category_id = products.category WHERE id = :id AND status = "Online"', 
    [
        ':id' => $params['id']
    ])->findOrFail();
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://tudorhalatiu.com/shop/" . $product['category_slug'] . "/" . $product['slug'], true, 301);
    exit();
}
// Normal url with SLUG
elseif (isset($params['slug']) && is_string($params['slug']) && preg_match('/^[a-zA-Z0-9\-]+$/', $params['slug'])) {
    $product = $db->query('SELECT id, products.name, products.slug, discount, category, sizes, stock, price, excerpt, description, status, categories.name AS category_name FROM products LEFT JOIN categories ON categories.category_id = products.category WHERE products.slug = :slug AND status = "Online"', 
    [
        ':slug' => $params['slug']
    ])->findOrFail();
        
    $pageViewCounter = new ProductViewCounter();
    $pageViewCounter->incrementPageView($product['id']);

    $categories = $db->query('SELECT category_id, name, slug FROM categories')->get();

    $getViews = $db->query('SELECT SUM(views) AS views FROM product_views WHERE product_id = :id', [':id' => $product['id']])->get();

    $imagesFiles = glob(base_path('public/images/products/'.$product['id'].'/*.{jpg,png,avif,jpeg}'), GLOB_BRACE);
    if($imagesFiles !== false and count($imagesFiles) > 0)
        foreach($imagesFiles as $key => $file) 
            if (strpos($file, 'poster') === false) 
                $imagesFiles[$key] = str_replace(base_path(), '', $file);
            else 
                unset($imagesFiles[$key]);

    $schema = new SchemaGenerator('Product.json');
    $schema = $schema->generateSchema([
                            'name' => $product['name'],
                            'excerpt' => $product['excerpt'],
                            'category_name' => $product['category_name'],
                            'price' => $product['price'],
                            'id' => $product['id'],
                            'shipping_tax' => 21,
                        ]);

     view('products/view', [
        'heading' => $product['name'],
        'heading_info' => 'Produs din categoria ' .$product['category_name'],
        'product' => $product,
        'title' => ucwords(strtolower($product['name'])) . ' by Tudor Halațiu - creator de modă',
        'description' => $product['excerpt'] . ' by Tudor Halațiu creator de modă',
        'categories' => $categories,
        'views' => $getViews[0]['views'],
        'photos' => $imagesFiles,
        'schema' => $schema
    ]);
}
else abort();