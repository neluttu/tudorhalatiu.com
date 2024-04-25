<?
use Core\App;
$db = App::resolve('Core\Database');
//dd($params['category']);
$products = $db->query('SELECT products.*, (SELECT count(views) AS views FROM product_views WHERE product_id = products.id) AS views, categories.name AS category_name FROM products LEFT JOIN categories ON categories.category_id = products.category ORDER BY category_name, products.name')->get();

view('admin/products', [
    'heading' => 'Produse magazin online',
    'heading_info' => $db->totlaRows() . ' produse în total',
    'products' => $products,
    'title' => 'Admin: Produse magazin online',
    'currentCategory' => null,
]);
