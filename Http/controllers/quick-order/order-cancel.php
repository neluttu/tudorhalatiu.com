<?
use Core\App;
use Core\Session;

$db = App::resolve(\Core\Database::class);
$order_id = $_POST['id'];
$token = $_POST['token'];

// TODO: wtf man...
if($update = $db->query("UPDATE orders SET status = 'Canceled' WHERE id = :id and token = :token", [ ':id' => $order_id, ':token' => $token ]))
    Session::flash('message', ['success' => 'Comanda a fost anulată cu succes.', 'type' => 'success']);
else
    Session::flash('message', ['error' => 'Comanda a fost anulată cu succes.', 'type' => 'error']);

redirect('/comanda-client/' . $token);