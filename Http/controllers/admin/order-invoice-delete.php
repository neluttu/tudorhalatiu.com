<?
use Core\App;
use Core\Database;

$token = $_POST['token'];
$invoice = BASE_PATH . 'public/invoices/'.$token.'.pdf';
$order_id = $_POST['order_id'];

if(strlen($token) === 32 and is_file($invoice)) {
    $user_id = isset($_SESSION['user']['id']) ? $_SESSION['id'] : NULL;

    $db = App::resolve(Database::class);
    $order = $db->query("SELECT id FROM orders WHERE token = :token AND user_id = :user_id AND id = :order_id", [
                        ':token' => $token,
                        ':user_id' => $user_id,
                        ':order_id' => $order_id
                ])->findOrFail;

    if(!unlink($invoice))
        abort();        
}

redirect('/admin/order/' . $order_id);