<?
use Core\App;
use Http\Forms\RegisterForm;
use Core\Session;

$email = $_POST['email'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];

$form = new RegisterForm();

$db = App::resolve(Core\Database::class);
$user = $db->query("SELECT * FROM users WHERE email = :email", [':email' => $email])->find();

if(!$form->validate($email, $password, $firstname, $lastname, $phone) or $user) {

    if($user) $form->appendError('email', 'This email is already registered...');

    Session::flash('errors', $form->errors());
    Session::flash('old', [ 
        'email' => $email,
        'firstname' => $firstname,
        'lastname' => $lastname,
        'phone' => $phone
        ]);    
        
    redirect ('/register');
    die();
}

$db->query("INSERT INTO users (email, password, firstname, lastname, phone) VALUES (:email, :password, :firstname, :lastname, :phone)",[
    'email' => $email,
    'password' => password_hash($password, PASSWORD_BCRYPT),
    'firstname' => $firstname,
    'lastname' => $lastname,
    'phone' => $phone
]);

$_SESSION['user'] = [
    'email' => $email,
    'name' => $firstname,
    'id' => $db->getLastID()
];

session_regenerate_id(true);
header('Location: /account');