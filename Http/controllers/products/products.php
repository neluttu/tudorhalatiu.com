<?
use Core\App;

// //$_SESSION['shopping_cart'] = [];
// if($method === 'POST') {

//     $postArray = [ 
//         $_POST['id'] => [
//             'price' => $_POST['price'],
//             'name' => $_POST['name'],
//             'quantity' => $_POST['quantity']
//         ]
//     ];

//     if(empty($_SESSION['shopping_cart'])) {
//             $_SESSION['shopping_cart'] = $postArray;
            
//             $Result = 'Product added to empty cart!';
//     }
//     else {
//         if(isset($_SESSION['shopping_cart'][$_POST['id']])) {
//             $_SESSION['shopping_cart'][$_POST['id']]['quantity'] += $_POST['quantity'];
//             $Result = 'Product quantity modified!';
//         }
//         else {
//             $array_keys = array_keys($_SESSION['shopping_cart']);

//             if(in_array($_POST['id'], $array_keys))
//                 $Result = 'Product already in basket.';
//             else {
//                 $_SESSION["shopping_cart"] += $postArray;
//                 $Result = 'Product added in your cart!';

//             }
//         }
//     }

// }
// else $Result = false;
$db = App::resolve('Core\Database');

$products = $db->query('SELECT * FROM products WHERE category = :id', 
                    [
                        'id' => $params['id']
                    ])->get();

$category = $db->query('SELECT name FROM categories WHERE category_id = :id', 
                        [
                            'id' => $params['id']
                        ]
                        )->find();

view('products/products', [
    'heading' => $category['name'],
    'products' => $products,
    // 'Result' => $Result
]);
?>