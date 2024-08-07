<?
use Core\App;
use Core\Database;

$user_id = $_SESSION['user']['id'];
$orders = App::resolve(Database::class)->query("
                                                SELECT 
                                                orders.id AS order_id,
                                                orders.ordered_at,
                                                orders.shipping_tax,
                                                orders.status,
                                                orders.payed,
                                                orders.payment_type,
                                                orders.awb,
                                                /* If you update below, it will break the view */
                                                GROUP_CONCAT(CONCAT_WS(':', ordered_products.product_id, ordered_products.name, ordered_products.price, ordered_products.discount, ordered_products.currency, ordered_products.quantity, ordered_products.size) SEPARATOR ';') AS products
                                                FROM 
                                                orders
                                                LEFT JOIN ordered_products ON orders.id = ordered_products.order_id
                                                WHERE 
                                                orders.user_id = '".$user_id."'
                                                GROUP BY 
                                                orders.id
                                                ORDER BY 
                                                orders.ordered_at DESC;
                                                ")->get();

$status = [ 'Pending' => 'În așteptare', 'Processing' => 'În lucru', 'Completed' => 'Finalizată', 'Canceled' => 'Anulată' ];

view('account/orders', [
    'heading' => 'Comnezi magazin',
    'heading_info' => 'Vizualizare comenzi și facturi.',
    'orders' => $orders,
    'status' => $status
]);