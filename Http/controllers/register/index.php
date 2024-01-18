<?
use Core\Session;

view('registration/index', [
    'heading' => Core\Lang::text('heading.register.0'),
    'heading_info' => Core\Lang::text('heading.register.1'),
    'errors' => Session::get('errors')
]);