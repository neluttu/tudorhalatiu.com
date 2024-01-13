<?
use Core\Session;
use Core\App;
use Core\Database;
use Core\ShoppingCart;

$db = App::resolve(Database::class);


// Check if the product ID from the page matches the product ID in the database.
$checkID = $db->query('SELECT id FROM products WHERE id = :id LIMIT 1', 
                    [
                        'id' => $_POST['id']
                    ])->totlaRows();

$shoppingCart = new ShoppingCart();

if (empty($_POST['cartID']) && $checkID === 1) 
    $result = $shoppingCart->addProduct($_POST);
                    
Session::flash('cart_message', [ 
                    'result' => $result
            ]);

return redirect('/product/' . slug($_POST['name']) . '/' . $_POST['id']);