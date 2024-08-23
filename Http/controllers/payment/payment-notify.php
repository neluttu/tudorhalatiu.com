<?php
use Core\Twispay;
use Core\Database;
use Core\App;
use Core\EmailSender;

if ($_POST['opensslResult']) {
    $data = json_decode(decrypt($_POST['opensslResult'], Twispay::getKey()), true);
    if (is_array($data) && !empty($data)) {

        // Get client order ID
        $order_id = explode('-', $data['externalOrderId'])[0]; 
        $user_id = is_numeric($data['identifier']) ? (int)$data['identifier'] : null;

        // Database connection
        $db = App::resolve(Database::class);

        // Insert TwisPay response into twispay_payments but first check if the $_POST['opensslResult'] is not present in the database.
        if(!$db->query("SELECT id FROM twispay_payments WHERE response = :response AND order_id = :order_id AND user_id = :user_id", 
                        [
                            ':response' => $_POST['opensslResult'],
                            ':order_id' => $order_id,
                            ':user_id' => $user_id,
                        ])->find()) 
        {
            if($db->query("INSERT INTO twispay_payments (order_id, response, transaction_status, transaction_id, twispay_order_id, transaction_method, transaction_type, twispay_customer_id, user_id, amount, currency, timestamp)
                                VALUES (:order_id, :response, :transaction_status, :transaction_id, :twispay_order_id, :transaction_method, :transaction_type, :twispay_customer_id, :user_id, :amount, :currency, :timestamp)", 
                                    [
                                        ':order_id' => $order_id, 
                                        ':response' => $_POST['opensslResult'], 
                                        ':transaction_status' => $data['transactionStatus'], 
                                        ':transaction_id' => $data['transactionId'], 
                                        ':twispay_order_id' => $data['orderId'], 
                                        ':transaction_method' => $data['transactionMethod'], 
                                        ':transaction_type' => $data['transactionType'], 
                                        ':twispay_customer_id' => $data['customerId'], 
                                        ':user_id' => $user_id, 
                                        ':amount' => number_format($data['amount'], 2, '.', ''), 
                                        ':currency' => $data['currency'], 
                                        ':timestamp' => $data['timestamp'],
                                        ]
                                ))
            echo 'OK';
        }

        // $adminNotify = new EmailSender();
        // $adminNotify->sendEmail(
        //     'ionel.olariu@gmail.com',
        //     $_POST['opensslResult'],
        //     'views/emails/StatusChange.html',
        //     []
        //     );
                                        

        // Begin transaction
        $db->beginTransaction();

        try {
            // Check if the order is not yet marked as paid
            if ($order = $db->query("SELECT payed FROM orders WHERE id = :order_id AND payed = 'No'", [':order_id' => $order_id])->find()) {
                if($data['transactionStatus'] === 'complete-ok') {
                    // Update the order in the orders table
                    $db->query("UPDATE orders SET payed = 'Yes', twispay_orderId = :orderId, twispay_transactionId = :transactionId, twispay_customerId = :customerId, twispay_timestamp = :timestamp WHERE id = :externalOrderId", [
                        ':orderId' => $data['orderId'], // Twispay order ID
                        ':transactionId' => $data['transactionId'], // Twispay transaction ID
                        ':customerId' => $data['customerId'], // Twispay customer ID
                        ':externalOrderId' => $order_id, // Local db order ID,
                        ':timestamp' => date('Y-m-d H:i:s', $data['timestamp']) // Twispay timestamp of transaction
                    ]);

                    // Commit transaction
                    $db->commit();
                }
            }
        } catch (Exception $e) {
            // Rollback transaction
            $db->rollBack();
            //echo 'ERROR: ' . $e->getMessage();
        }
    }
} else echo 'f';
