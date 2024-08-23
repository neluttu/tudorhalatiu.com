<?php
use Core\Session;
use Core\App;
use Core\Twispay;

$data = json_decode(decrypt($_POST['opensslResult'], Twispay::getKey()), true);
$errors = [];
if (is_array($data) && !empty($data)) {
    // Set userID / no userID
    $user_id = is_numeric($data['identifier']) ? (int)$data['identifier'] : null;
    // Get client order ID
    $order_id = explode('-', $data['externalOrderId'])[0];
    
    $db = App::resolve(Core\Database::class);

    // Get token for no account orders
    if ($user_id === null) 
        $order = $db->query("SELECT token FROM orders WHERE id = :order_id", [':order_id' => $order_id])->find();
    $result_url = isset($order['token']) ? '/comanda-client/' . $order['token'] : '/account/order/' . $order_id;

    // Begin transaction
    $db->beginTransaction();
    try {
        // Check if the order is not yet marked as paid
        if ($checkOrder = $db->query("SELECT payed, token FROM orders WHERE id = :order_id AND payed = 'No'", [':order_id' => $order_id])->find()) {
            
            if ($data['transactionStatus'] === 'complete-ok') {
                // Transaction successful, update order in db.
                $db->query("UPDATE orders SET payed = 'Yes', twispay_orderId = :orderId, twispay_transactionId = :transactionId, twispay_customerId = :customerId, twispay_timestamp = :timestamp WHERE id = :externalOrderId AND payed = 'No'", [
                                    ':orderId' => $data['orderId'], // Twispay order ID
                                    ':transactionId' => $data['transactionId'], // Twispay transaction ID
                                    ':customerId' => $data['customerId'], // Twispay customer ID
                                    ':externalOrderId' => $order_id, // Local db order ID,
                                    ':timestamp' => date('Y-m-d H:i:s', $data['timestamp']) // Twispay timestamp of transaction
                                ]);
                            } 
            else {
                $errors = [
                    'payment' => false,
                    'message' => Twispay::code($data['errors'][0]['code']),
                ];
                }
            }
    } catch (Exception $e) {
        // Rollback transaction
        $db->rollBack();
        //echo 'ERROR: ' . $e->getMessage();
    }
    
    if (empty($errors)) {
        $db->commit();
        Session::flash('order', [
            'token' => $order['token'] ?? '', 
            'order_id' => (int) $order_id
        ]);
        redirect('/payment-successful');
        die();
    }

    // Flash errors and redirect user to order page
    Session::flash('errors', $errors);    
    // Custom redirect
    redirect($result_url);
}
//abort();
