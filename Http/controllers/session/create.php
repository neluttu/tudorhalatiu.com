<?
use Core\Session;
view('session/create',[
    'heading' => Core\Lang::text('heading.login.0'),
    'heading_info' => Core\Lang::text('heading.login.1'),
    'title' => 'Cont client TudorHalatiu.com - creator de modă, haine, vestimentație',
    'description' => 'Autentificare magazin online haine, vestimentatie TudorHalatiu.com - creator de modă',
    'errors' => Session::get('errors'),
    'message' => Session::get('message')
]);