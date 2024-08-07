<?
use Core\App;
use Core\Database;

$order_id = $params['id'];
$db = App::resolve(Database::class);

$order = $db->query("SELECT * FROM orders WHERE id = :id", 
                                                [
                                                    ':id' => $order_id
                                                ])->findOrFail();

$billing = $db->query("SELECT * FROM orders_billing WHERE order_id = '".$order_id."' LIMIT 1")->find();
$shipping = $db->query("SELECT * FROM orders_shipping WHERE order_id = '".$order_id."' LIMIT 1")->find();
                                                
$products = $db->query("SELECT ordered_products.order_id, ordered_products.product_id, ordered_products.name, ordered_products.price, ordered_products.discount, ordered_products.currency, ordered_products.quantity, ordered_products.size, products.category, products.slug, categories.slug AS category_slug 
                                                FROM ordered_products 
                                                LEFT JOIN products ON products.id = ordered_products.product_id 
                                                LEFT JOIN categories ON categories.category_id = products.category
                                                WHERE order_id = '".$order['id']."'")->get();

$status = [ 'Pending' => 'În așteptare', 'Processing' => 'În lucru', 'Completed' => 'Finalizată', 'Canceled' => 'Anulată' ];

view('admin/order', [
    'heading' => 'Comanda nr. '. str_pad($order['id'], 6, '0', STR_PAD_LEFT),
    'heading_info' => 'Plasată în ' . roDate($order['ordered_at']),
    'order' => $order,
    'products' => $products,
    'billing' => $billing,
    'shipping' => $shipping,
    'status' => $status,
    'sizes' => ['XS','S','M','L','XL','ONE SIZE']
]);

