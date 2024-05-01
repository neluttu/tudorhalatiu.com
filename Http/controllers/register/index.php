<?
use Core\Session;

view('registration/index', [
    'heading' => Core\Lang::text('heading.register.0'),
    'heading_info' => Core\Lang::text('heading.register.1'),
    'title' => 'Client nou TudorHalatiu.com - creator de modă, haine, vestimentație',
    'description' => 'Creare cont nou în magazinul online haine, vestimentatie TudorHalatiu.com - creator de modă',
    'errors' => Session::get('errors')
]);