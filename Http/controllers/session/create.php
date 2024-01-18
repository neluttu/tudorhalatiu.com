<?
use Core\Session;

view('session/create',[
    'heading' => Core\Lang::text('heading.login.0'),
    'heading_info' => Core\Lang::text('heading.login.1'),
    'errors' => Session::get('errors'),
    'message' => Session::get('message')
]);