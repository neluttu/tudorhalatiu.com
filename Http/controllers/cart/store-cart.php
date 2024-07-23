<?
use Core\Session;
use Core\App;
use Core\Database;
use Core\ShoppingCart;
$db = App::resolve(Database::class);


// Check if the product ID from the page matches the product ID in the database.
if($checkID = $db->query('SELECT id, name, price, weight, discount FROM products WHERE id = :id AND stock = "Yes" AND status = "Online" LIMIT 1', 
                    [
                        'id' => $_POST['id']
                    ])->find())
{

    $shoppingCart = new ShoppingCart();

    // store POST data into new variable.
    $cartItems = $_POST;

    // Update cart item values from db.
    $cartItems['name'] = $checkID['name'];
    $cartItems['price'] = $checkID['price'];
    $cartItems['weight'] = $checkID['weight'];
    $cartItems['discount'] = $checkID['discount'];

//    if (empty($_POST['cartID'])) 
    $result = $shoppingCart->addProduct($cartItems);
                        
    Session::flash('cart_message', [ 
                        'result' => $result
                ]);
}
return redirect('/cart');