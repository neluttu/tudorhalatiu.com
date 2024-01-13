<?
use Core\Session;

view('registration/index', [
    'heading' => 'Register your account',
    'errors' => Session::get('errors')
]);