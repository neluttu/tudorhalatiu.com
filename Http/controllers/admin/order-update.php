<?
use Core\Database;
use Core\App;
use Core\EmailSender;

if($_POST['order_id']) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    $awb = $_POST['awb'];
    $status_translate = [ 'Pending' => 'În așteptare', 'Processing' => 'În lucru', 'Completed' => 'Finalizată', 'Canceled' => 'Anulată' ];

    $db = App::resolve(Database::class);
    $data = $db->query("SELECT status, email, firstname FROM orders LEFT JOIN orders_billing ON orders_billing.order_id = orders.id WHERE id = $order_id")->find();

    $update = $db->query("UPDATE orders SET awb = :awb, status = :status WHERE id = :order_id", [
                            ':awb' => $awb,
                            ':status' => $status,
                            ':order_id' => $order_id
                        ]);

    

    if($data['status'] != $status) {
        $notify_client = new EmailSender();
        $notify_client->sendEmail(
            $data['email'],
            'Modificare stare comandă #' . $order_id,
            'views/emails/StatusChange.html',
            [
                'firstname' => $data['firstname'],
                'order_id' => str_pad($order_id, 6, '0', STR_PAD_LEFT),
                'status' => $status_translate[$status],
                'host' => $_SERVER['HTTP_HOST']
            ]);
    }
    redirect('/admin/order/' . $order_id);
}
else redirect('/admin');