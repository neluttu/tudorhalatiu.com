<?
use Core\App;
use Core\Database;

$orders = App::resolve(Database::class)->query("
                                                SELECT 
                                                orders.id AS order_id,
                                                orders.user_id,
                                                orders.ordered_at,
                                                orders.status,
                                                orders.payed,
                                                orders.shipping_tax,
                                                orders.payment_type,
                                                orders.awb,
                                                users_data.firstname,
                                                users_data.lastname,
                                                users_data.phone,
                                                GROUP_CONCAT(CONCAT_WS(':', ordered_products.product_id, ordered_products.name, ordered_products.price, ordered_products.discount, ordered_products.currency, ordered_products.quantity, ordered_products.size) SEPARATOR ';') AS products
                                                FROM 
                                                orders
                                                LEFT JOIN ordered_products ON orders.id = ordered_products.order_id
                                                LEFT JOIN users_data ON orders.user_id = users_data.user_id
                                                GROUP BY 
                                                orders.id
                                                ORDER BY 
                                                orders.ordered_at DESC;
                                                ")->get();

$status = [
    'Pending' => 'slate',
    'Completed' => 'green',
    'Canceled' => 'red',
    'Processing' => 'orange'
];

view('admin/orders', [
    'heading' => 'Secțiune administrator ',
    'heading_info' => 'Comenzi, clienti, produse, facturi.',
    'orders' => $orders,
    'status' => $status
]);