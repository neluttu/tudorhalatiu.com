<?
use Core\App;
use Http\Forms\UpdateAccountData;
use Core\Session;

$password = $_POST['password'];
$password_verify = $_POST['password_verify'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];

$form = new UpdateAccountData();


if(!$form->validate($password, $firstname, $lastname, $phone)) {
    Session::flash('errors', $form->errors());
    redirect ('/account');
    die();
}

$db = App::resolve(Core\Database::class);
$db->query("UPDATE users_data SET firstname = :firstname, lastname = :lastname, phone = :phone WHERE user_id = '".$_SESSION['user']['id']."'",
        [
            ':firstname' => $firstname,
            ':lastname' => $lastname,
            ':phone' => $phone,
        ]
    );

// if New Password was requested:
if($password) {
    if($password === $password_verify) {
        $db->query("UPDATE users SET password = :password WHERE id = :id", 
                    [
                        ':password' => password_hash($password, PASSWORD_BCRYPT),
                        ':id' => $_SESSION['user']['id']
                    ]);
        Session::flash('errors', ['password' => 'Parola contului a fost modificată cu succes!']);
    }
    else Session::flash('errors', ['password' => 'Parola de verificare nu coincide cu parola aleasă.']);
}
redirect('/account');