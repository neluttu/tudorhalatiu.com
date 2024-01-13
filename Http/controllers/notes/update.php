<?
use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$note = $db->query('SELECT * FROM notes WHERE id = :id', 
                    [
                        'id' => $_POST['id']
                    ])->findOrFail();

authorize($note['user_id'] === $_SESSION['user']['id']);

$errors = [];

if(!Validator::string($_POST['note'], 1, 500)) {
    $errors['note'] = 'Invalid note length';
}

if(!empty($errors)) { 
    return view('notes/edit', [
        'heading' => 'Edit note',
        'errors' => $errors,
        'note' => $note
    ]);
}

$db->query('UPDATE notes set note = :note where id = :note_id', [
    ':note' => $_POST['note'],
    ':note_id' => $_POST['id']
]);

header('Location: /notes');
die();