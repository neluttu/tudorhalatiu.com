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
redirect('/account');