<?
if(isset($_SESSION['cart']) and count($_SESSION['cart']) > 0)
    view('cart/index', [
        'heading' => 'Shopping cart',
    ]);
else 
    view('cart/no-items', [
        'heading' => 'Your shopping cart',
    ]);
?>