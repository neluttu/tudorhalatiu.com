<?
use Core\Session;
use Core\App;
$data = json_decode(decrypt($_POST['opensslResult'], \Core\Twispay::getKey()), true);

if(is_array($data)) {

    Session::flash('payment', $data);

    // Set userID / no userID
    $user_id = $data['identifier'] != 99999 ? $data['identifier'] : NULL;
    $orderId = explode('-',$data['externalOrderId']);

    $db = App::resolve(Core\Database::class);

    // get token for no account orders
    if($user_id === NULL) 
        $order = $db->query("SELECT token FROM orders WHERE id = :order_id", [ ':order_id' => $orderId[0] ])->find();

    if($data['transactionStatus'] === 'complete-ok') {

        // update successful order payment based solely on $externalOrderId!!!
        $update = $db->query("UPDATE orders SET payed = 'Yes', twispay_orderId = :orderId, twispay_transactionId = :transactionId, twispay_customerId = :customerId, twispay_timestamp = :timestamp WHERE id = :externalOrderId", 
                            [
                                ':orderId' => $data['orderId'], // twispay order ID
                                ':transactionId' => $data['transactionId'], // TwisPay transaction ID
                                ':customerId' => $data['customerId'], // TwisPay customer ID
                                //':identifier' => $user_id, // local db user ID
                                ':externalOrderId' => $orderId[0], // local db order ID,
                                ':timestamp' => date('Y-m-d H:i:s', $data['timestamp']) // TwisPay timestamp of transaction
                                ]
                        );
        
        if($update) {
            //\Core\ShoppingCart::emptyCart();
            $order['token'] ? redirect('/comanda-client/' . $order['token']) : redirect('/account/order/' . $orderId[0]);
        }
            
    }
    else {
        $order['token'] ? redirect('/comanda-client/' . $order['token']) : redirect('/payment-failed');
    }
}
redirect();