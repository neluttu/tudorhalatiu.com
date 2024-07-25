<?
use Core\Twispay;

$orderData = Core\Session::get('orderData');
if($orderData) {
    $base64JsonRequest = Twispay::getBase64JsonRequest($orderData);
    $base64Checksum = Twispay::getBase64Checksum($orderData, Twispay::getKey());
    
    view('payment/payment-redirect', [
        'heading' => 'Redirectare plată online',
        'heading_info' => 'Finalizează procesul de plată online',
        'title' => 'Plată online - Tudor Halațiu',
        'description' => 'Transfer către procesatorul de plăți online - Twispay',
        'orderData' => Core\Session::get('orderData'),
        'base64Checksum' => $base64Checksum,
        'base64JsonRequest' => $base64JsonRequest,
        'twispayLive' => false
    ]);
}
else redirect();