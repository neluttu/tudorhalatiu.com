<?
use Core\App;

$db = App::resolve('Core\Database');

 $clients = $db->query('SELECT id, email, firstname, lastname, status, created_at, phone FROM users LEFT JOIN users_data ON users_data.user_id = users.id')->get();

view('admin/clients', [
    'heading' => 'Clienți magazin online',
    'heading_info' => 'Lista tuturor clienților',
    'clients' => $clients
]);