<?
use Core\Session;
use Core\App;

$data = json_decode(decrypt($_POST['opensslResult'], \Core\Twispay::getKey()), true);

if(is_array($data)) {
    Session::flash('payment', $data);

    if($data['transactionStatus'] === 'complete-ok') {
        // Set userID / no userID
        $user_id = $data['identifier'] != 0 ? $data['identifier'] : NULL;
        $orderId = explode('-',$data['externalOrderId']);
        $db = App::resolve(Core\Database::class);
        $update = $db->query("UPDATE orders SET payed = 'Yes', twispay_orderId = :orderId, twispay_transactionId = :transactionId, twispay_customerId = :customerId, twispay_timestamp = :timestamp WHERE user_id = :identifier AND id = :externalOrderId", 
                            [
                                ':orderId' => $data['orderId'], // twispay order ID
                                ':transactionId' => $data['transactionId'], // TwisPay transaction ID
                                ':customerId' => $data['customerId'], // TwisPay customer ID
                                ':identifier' => $user_id, // local db user ID
                                ':externalOrderId' => $orderId[0], // local db order ID,
                                ':timestamp' => date('Y-m-d H:i:s', $data['timestamp']) // TwisPay timestamp of transaction
                                ]
                        );
        
        if($update) {
            //\Core\ShoppingCart::emptyCart();
            
            redirect('/payment-successful');
        }
            
    }
    else {
        redirect('/payment-failed');
    }
}

redirect();