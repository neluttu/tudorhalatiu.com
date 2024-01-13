<?
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$note = $db->query('SELECT * FROM notes WHERE id = :id', 
                    [
                        'id' => $params['id']
                    ])->findOrFail();


authorize($note['user_id'] === $_SESSION['user']['id']);
view('notes/edit', [
    'heading' => 'Edit note',
    'errors' => [],
    'note' => $note
]);