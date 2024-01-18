<?
$Page = (isset($_SESSION['cart']) and count($_SESSION['cart']) > 0) ? 'index' : 'no-items';

view('cart/' . $Page, [
    'heading' => Core\Lang::text('heading.cart.0'),
    'heading_info' => Core\Lang::text('heading.cart.1'),
]);
