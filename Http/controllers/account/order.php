<?
use Core\App;
use Core\Database;

$user_id = $_SESSION['user']['id'];
$order_id = $params['id'];

$order = App::resolve(Database::class)->query("SELECT * FROM orders WHERE user_id = '".$user_id."' AND id = :id", 
                                                [
                                                    ':id' => $order_id
                                                ])->findOrFail();

$order_info = App::resolve(Database::class)->query("SELECT * FROM users_address WHERE user_id = '".$user_id."' LIMIT 2")->get();

foreach($order_info as $info) 
    $info['type'] === 'billing' ? $billing = $info : $shipping = $info;

$products = App::resolve(Database::class)->query("SELECT ordered_products.order_id, ordered_products.product_id, ordered_products.name, ordered_products.price, ordered_products.discount, ordered_products.currency, ordered_products.quantity, ordered_products.size, products.category, products.slug, categories.slug AS category_slug 
                                                FROM ordered_products 
                                                LEFT JOIN products ON products.id = ordered_products.product_id 
                                                LEFT JOIN categories ON categories.category_id = products.category
                                                WHERE order_id = '".$order['id']."'")->get();

$status = [ 'Pending' => 'În așteptare', 'Processing' => 'În lucru', 'Completed' => 'Finalizată', 'Canceled' => 'Anulată' ];

view('account/order', [
    'heading' => 'Comanda nr. '. str_pad($order['id'], 6, '0', STR_PAD_LEFT),
    'heading_info' => 'Plasată în ' . roDate($order['ordered_at']),
    'order' => $order,
    'products' => $products,
    'billing' => $billing,
    'shipping' => $shipping,
    'status' => $status
]);