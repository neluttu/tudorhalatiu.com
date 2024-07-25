<?
use Core\Session;
use Core\App;
use Core\Twispay;

$data = json_decode(decrypt($_POST['opensslResult'], \Core\Twispay::getKey()), true);
if(is_array($data) && !empty($data)) {

    // Set userID / no userID
    $user_id = is_numeric($data['identifier']) ? (int)$data['identifier'] : null;
    
    // Get client order ID
    $order_id = explode('-',$data['externalOrderId'])[0];
    
    $db = App::resolve(Core\Database::class);

    // get token for no account orders
    if($user_id === null) 
        $order = $db->query("SELECT token FROM orders WHERE id = :order_id", [ ':order_id' => $order_id ])->find();

    $result_url = isset($order['token']) ? '/comanda-client/'. $order['token'] : '/account/order/' . $order_id;

    if($data['transactionStatus'] === 'complete-ok') {
        // Transaction successfull, update order in db.
        if(!$db->query("UPDATE orders SET payed = 'Yes', twispay_orderId = :orderId, twispay_transactionId = :transactionId, twispay_customerId = :customerId, twispay_timestamp = :timestamp WHERE id = :externalOrderId", 
                            [
                                ':orderId' => $data['orderId'], // twispay order ID
                                ':transactionId' => $data['transactionId'], // TwisPay transaction ID
                                ':customerId' => $data['customerId'], // TwisPay customer ID
                                ':externalOrderId' => $order_id, // local db order ID,
                                ':timestamp' => date('Y-m-d H:i:s', $data['timestamp']) // TwisPay timestamp of transaction
                                ]
                        ))
            // log if something goes wrong with the transaction
            $errors['sqlQuery'] = 'Eroare modificare status comandă în baza de date.';
    }
    else {
        $errors = [
            'paymnet' => false,
            'message' => Twispay::code($data['errors'][0]['code']),
        ];
    }

    if(empty($errors)) {
        Session::flash('order', [ 
                                'token' => $order['token'] ?? '', 
                                'order_id' => (int)$order_id
                                ]);
        redirect('/payment-successful');
    }

    // Flash errors and redirect user to order page
    Session::flash('errors', $errors);

    // Custom redirect
    redirect($result_url);
}
//abort();