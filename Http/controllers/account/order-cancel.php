<?
use Core\App;
use Core\Session;

$db = App::resolve(\Core\Database::class);
$order_id = $_POST['id'];

if($update = $db->query("UPDATE orders SET status = 'Canceled' WHERE id = :id and user_id = :user_id", [':id' => $order_id, ':user_id' => $_SESSION['user']['id']]))
    Session::flash('message', ['success' => 'Comanda a fost anulată cu succes.', 'type' => 'success']);
else
    Session::flash('message', ['error' => 'Comanda a fost anulată cu succes.', 'type' => 'error']);

redirect('/account/order/' . $order_id);