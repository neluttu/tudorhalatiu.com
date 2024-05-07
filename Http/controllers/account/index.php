<?
use Core\App;
use Core\Session;

$db = App::resolve(Core\Database::class);
$user = $db->query("SELECT * FROM users LEFT JOIN users_data ON users.id = users_data.user_id WHERE id = '".$_SESSION['user']['id']."'")->find();
view('account/index', [
    'heading' => 'Bună '. $_SESSION['user']['name'] ,
    'heading_info' => 'Administrați contul de client',
    'user' => $user,
    'errors' => Session::get('errors'),
    'message' => Session::get('message')
]);