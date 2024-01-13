<?
use Core\App;

$db = App::resolve('Core\Database');

$note = $db->query('SELECT * FROM notes WHERE id = :id', 
                    [
                        'id' => $_POST['id']
                    ])->findOrFail();

authorize($note['user_id'] === $_SESSION['user']['id']);

$db->query("DELETE FROM notes WHERE id = :id",[
    ':id' => $_POST['id']
]);

header('Location: /notes');
die();


?>