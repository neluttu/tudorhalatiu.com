<?php

use Core\App;
use Core\Database;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

// Adaugă o metodă în clasa Database (sau unde este nevoie) pentru a obține numărul total de înregistrări

// Numărul de rezultate pe pagină
$perPage = 999999;

// Determină pagina curentă
$currentPage = Paginator::resolveCurrentPage();

// Calculează offset-ul
$offset = ($currentPage - 1) * $perPage;
$totalOrders = App::resolve(Database::class)->query("SELECT id FROM orders")->totalRows();
// Obține toate comenzile pentru pagina curentă
$allOrders = App::resolve(Database::class)->query("
    SELECT 
    orders.id AS order_id,
    orders.user_id,
    orders.ordered_at,
    orders.status,
    orders.payed,
    orders.shipping_tax,
    orders.payment_type,
    orders.awb,
    orders_billing.firstname,
    orders_billing.lastname,
    orders_billing.phone,
    orders_billing.email,
    GROUP_CONCAT(CONCAT_WS(':', ordered_products.product_id, ordered_products.name, ordered_products.price, ordered_products.discount, ordered_products.currency, ordered_products.quantity, ordered_products.size) SEPARATOR ';') AS products
    FROM 
    orders
    LEFT JOIN ordered_products ON orders.id = ordered_products.order_id
    LEFT JOIN orders_billing ON orders.id = orders_billing.order_id
    GROUP BY 
    orders.id
    ORDER BY 
    orders.ordered_at DESC
    LIMIT $perPage OFFSET $offset;
")->get();

// Numărul total de comenzi


// Crearea paginatorului
$orders = new LengthAwarePaginator($allOrders, $totalOrders, $perPage, $currentPage, [
    'path' => Paginator::resolveCurrentPath(),
]);

$status = [
    'Pending' => 'slate',
    'Completed' => 'green',
    'Canceled' => 'red',
    'Processing' => 'orange'
];

// Generarea vizualizării
view('admin/orders', [
    'heading' => 'Secțiune administrator ',
    'heading_info' => 'Comenzi, clienti, produse, facturi.',
    'orders' => $orders,
    'status' => $status,
]);
