<?
use Core\App;
use Core\Database;
use Core\Twispay;
use Core\Session;

$user_id = $_SESSION['user']['id'];
$order_id = $params['id'];
$db = App::resolve(Database::class);

$order = $db->query("SELECT * FROM orders WHERE user_id = '".$user_id."' AND id = :id", 
                                                [
                                                    ':id' => $order_id
                                                ])->findOrFail();

$order_info = $db->query("SELECT * FROM users_address WHERE user_id = '".$user_id."' LIMIT 2")->get();

foreach($order_info as $info) 
    $info['type'] === 'billing' ? $billing = $info : $shipping = $info;

$products = $db->query("SELECT ordered_products.order_id, ordered_products.product_id, ordered_products.name, ordered_products.price, ordered_products.discount, ordered_products.weight, ordered_products.currency, ordered_products.quantity, ordered_products.size, products.category, products.slug, categories.slug AS category_slug 
                                                FROM ordered_products 
                                                LEFT JOIN products ON products.id = ordered_products.product_id 
                                                LEFT JOIN categories ON categories.category_id = products.category
                                                WHERE order_id = '".$order['id']."'")->get();

$amount = 0;
foreach($products as $product) 
    $amount += getPrice($product['price'], $product['discount']);

$status = [ 'Pending' => 'În așteptare', 'Processing' => 'În lucru', 'Completed' => 'Finalizată', 'Canceled' => 'Anulată' ];
$orderData = '';
$base64JsonRequest = '';
$base64Checksum = '';

if($order['payed'] == 'No' and $order['status'] != 'Canceled') {
    $orderData = [
        "siteId" => Twispay::getSiteID(),
        "customer" => [
            "identifier" => $user_id,
            "firstName" => $billing['firstname'],
            "lastName" => $billing['lastname'],
            "country" => 'RO',
            // "state" => $county,
            "city" => $billing['city'],
            "address" => $billing['address'],
            "zip" => $billing['zip'],
            "email" => $billing['email'],
            "phone" => $billing['phone']
        ],
        "order" => [
            "orderId" => $order['id'] . '-' . time(),
            "type" => "purchase",
            "amount" => number_format($amount + calculateShippingTax($products), 2, '.', ''),
            "currency" => "RON",
            "description" => "Comanda online nr. " . $order['id'],
        ],
        "cardTransactionMode" => "authAndCapture",
        "invoiceEmail" => $billing['email'], // edit with client email.
        "backUrl" => 'https://' . $_SERVER['HTTP_HOST'] . "/payment-result"
    ];    

    $base64JsonRequest = Twispay::getBase64JsonRequest($orderData);
    $base64Checksum = Twispay::getBase64Checksum($orderData, Twispay::getKey());
}


view('account/order', [
    'heading' => 'Comanda nr. '. str_pad($order['id'], 6, '0', STR_PAD_LEFT),
    'heading_info' => 'Plasată în ' . roDate($order['ordered_at']),
    'order' => $order,
    'products' => $products,
    'billing' => $billing,
    'shipping' => $shipping,
    'status' => $status,
    'orderData' => $orderData,
    'base64Checksum' => $base64Checksum,
    'base64JsonRequest' => $base64JsonRequest,
    'twispayLive' => true,
    'errors' => Session::get('errors'),

]);