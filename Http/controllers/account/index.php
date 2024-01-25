<?
view('account/index', [
    'heading' => 'Bună '. $_SESSION['user']['name'] ,
    'heading_info' => 'Administrați contul de client'
]);