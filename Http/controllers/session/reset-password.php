<?
use Core\Session;
view('session/reset-password',[
    'heading' => 'RESETARE PAROLĂ',
    'heading_info' => 'Cereți un link de resetare a parolei',
    'errors' => Session::get('errors'),
    'title' => 'Resetare parolă cont - Tudor Halațiu',
]);