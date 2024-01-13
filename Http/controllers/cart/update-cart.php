<?
use Core\Session;
use Core\ShoppingCart;

$shoppingCart = new ShoppingCart();

$result = $shoppingCart->updateProduct($_POST);

Session::flash('cart_message', [ 
                    'result' => $result
            ]);

return redirect('/cart');