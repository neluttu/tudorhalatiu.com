<?
view('payment/payment-successful',[
    'heading' => 'Livrare și retur',
    'heading_info' => 'Politica de livrare și retur produse',
    'title' => 'Tudor Halațiu - livrare și retur',
    'description' => 'Livrare și retur produse magazin online TudorHalatiu.com - creator de modă',
    'data' => \Core\Session::get('data')
]);