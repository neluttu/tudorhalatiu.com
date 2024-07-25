<?
use Core\Session;
$order = Session::get('order');

if(!$order) abort();

$order_url = $order['token'] ? '/comanda-client/' . $order['token'] : '/account/order/' . $order['order_id'];

view('payment/payment-successful',[
    'heading' => 'mulțumim!',
    'heading_info' => 'Comanda plasată a fost achitată',
    'title' => 'Tudor Halațiu - confirmare plată online',
    'description' => 'Tudor Halațiu - confirmare plată online',
    'order_url' => $order_url,
]);