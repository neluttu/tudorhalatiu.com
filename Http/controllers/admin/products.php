<?
use Core\App;
$db = App::resolve('Core\Database');
//dd($params['category']);
$query = '';
if(isset($_GET['filter'])) {
    $filter = $_GET['filter'];
    if($filter === 'stock') $query = " WHERE stock = 'No' ";
    elseif($filter === 'status') $query = " WHERE status = 'Offline' ";
    elseif($filter === 'discount') $query = " WHERE discount > 0 ";
}

$products = $db->query('SELECT products.*, (SELECT count(views) AS views FROM product_views WHERE product_id = products.id) AS views, categories.name AS category_name FROM products LEFT JOIN categories ON categories.category_id = products.category '.$query.' ORDER BY category_name, products.name')->get();

view('admin/products', [
    'heading' => 'Produse magazin online',
    'heading_info' => $db->totlaRows() . ' produse în total',
    'products' => $products,
    'title' => 'Admin: Produse magazin online',
    'currentCategory' => null
]);
