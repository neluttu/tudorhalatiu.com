<?
use Core\Database;
use Core\App;
use Core\Twispay;
use Core\Session;

$db = App::resolve(Database::class);
$order = $db->query("SELECT * FROM orders WHERE token = :token AND user_id IS NULL",
                                                [
                                                    ':token' => $params['token']
                                                ])->findOrFail();
                                                
$billing = $db->query("SELECT * FROM orders_billing WHERE order_id = '".$order['id']."' LIMIT 1")->find();
$shipping = $db->query("SELECT * FROM orders_shipping WHERE order_id = '".$order['id']."' LIMIT 1")->find();


$products = $db->query("SELECT ordered_products.order_id, ordered_products.product_id, ordered_products.name, ordered_products.price, ordered_products.weight, ordered_products.discount, ordered_products.currency, ordered_products.quantity, ordered_products.size, products.category, products.slug, categories.slug AS category_slug 
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
            "identifier" => $billing['email'], // set email address for quick orders w/o account
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
            //"items" => $orderProducts
        ],
        "cardTransactionMode" => "authAndCapture",
        "invoiceEmail" => 'ionel.olariu@gmail.com', // edit with client email.
        "backUrl" => 'https://' . $_SERVER['HTTP_HOST'] . "/payment-result"
    ];    

    $base64JsonRequest = Twispay::getBase64JsonRequest($orderData);
    $base64Checksum = Twispay::getBase64Checksum($orderData, Twispay::getKey());
}

view('client-order', [
    'heading' => 'Comanda nr. ' . $order['id'],
    'heading_info' => 'Client: ' . $billing['firstname'] . ' ' . $billing['lastname'] . ', din ' . roDate($order['ordered_at']),
    'title' => 'Comanda client',
    'description' => 'Comanda client',
    'token' => $params['token'],
    'order' => $order,
    'products' => $products,
    'billing' => $billing,
    'shipping' => $shipping,
    'status' => $status,
    'orderData' => $orderData,
    'base64Checksum' => $base64Checksum,
    'base64JsonRequest' => $base64JsonRequest,
    'twispayLive' => false,
    'errors' => Session::get('errors'),
]);