<?
use Core\App;

$db = App::resolve('Core\Database');

$product = $db->query('SELECT id, products.name, products.slug, category, sizes, price, excerpt, description, status, stock, categories.name AS category_name FROM products LEFT JOIN categories ON categories.category_id = products.category WHERE id = :id', 
                    [
                        'id' => $params['id']
                    ])->findOrFail();

$categories = $db->query('SELECT category_id, name, slug FROM categories')->get();

$imagesFiles = glob(base_path('public/images/products/'.$product['id'].'/*.{jpg,png,avif,jpeg}'), GLOB_BRACE);
if($imagesFiles !== false and count($imagesFiles) > 0)
    foreach($imagesFiles as $key => $file) 
        $imagesFiles[$key] = str_replace(base_path(), '', $file);

        $slugs = [
            'rochie-dolly',
            'rochie-luna',
            'rochie-aura',
            'rochie-secret-smarald',
            'pantalon-sour-cherry',
            'fusta-amour-noir',
            'jacheta-golden-desire',
            'pelerina-midnight',
            'camasa-addiction',
            'hanorac-dante',
            'corset-soft-baroque',
            'geanta-poison',
            'gulerul-gold-vintage',
            'camasa-after-eight',
            'corset-midnight-call',
            'fusta-butterfly',
            'fusta-green-fire',
            'fusta-midnight-call',
            'fusta-soft-glamour',
            'hanorac-butterfly',
            'jacheta-midnight-call',
            'rochie-dark-ocean',
            'rochie-pinky-promise',
            'sacou-red-light',
            'sacou-soft-glamour'
            ];                
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