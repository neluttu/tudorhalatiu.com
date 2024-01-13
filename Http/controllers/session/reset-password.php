<?
use Core\Session;
view('session/reset-password',[
    'heading' => 'Reset password',
    'errors' => Session::get('errors')
]);