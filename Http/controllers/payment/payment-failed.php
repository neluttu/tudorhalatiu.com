<?
view('payment/payment-failed',[
    'heading' => 'Rezultat plată comandă online',
    'heading_info' => 'Statusul plății comenzii',
    'title' => 'Rezultat plată comandă online',
    'description' => 'Rezultat plată comandă online',
    'data' => \Core\Session::get('payment')
]);