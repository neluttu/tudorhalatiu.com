<?
use Core\App;

// $db = App::resolve('Core\Database');

// $product = $db->query('SELECT id, products.name, category, sizes, price, excerpt, description, status, stock, categories.name AS category_name FROM products LEFT JOIN categories ON categories.category_id = products.category WHERE id = :id', 
//                     [
//                         'id' => $params['id']
//                     ])->findOrFail();

view('admin/clients', [
    'heading' => 'Clienți magazin online',
    'heading_info' => 'Lista tuturor clienților',
]);