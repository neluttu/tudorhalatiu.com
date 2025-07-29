<?
use Core\App;
use Http\Forms\RegisterForm;
use Core\Session;

$email = $_POST['email'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];
$telephone = $_POST['Telephone'];

$form = new RegisterForm();

$db = App::resolve(Core\Database::class);
$user = $db->query("SELECT * FROM users WHERE email = :email", [':email' => $email])->find();

if(!$form->validate($email, $password, $firstname, $lastname, $phone, $telephone) or $user) {

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

$db->query("
        INSERT INTO users (email, password, status, remote_addr)
        VALUES (:email, :password, 'Active', INET_ATON(:ipAddress))
        ", 
        [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'ipAddress' => $_SERVER['REMOTE_ADDR'],
        ]
    );

$user_id = $db->getLastID();

$db->query("
        INSERT INTO users_data (user_id, firstname, lastname, phone)
        VALUES (:user_id, :firstname, :lastname, :phone)
        ", 
        [
            'user_id' => $user_id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phone' => $phone,
        ]
    );

    // Add default fields for billing / shipping information.
    $db->query("
                INSERT INTO users_address (user_id, type, firstname, lastname, phone, email)
                VALUES (:user_id, 'billing', :firstname, :lastname, :phone, :email);

                INSERT INTO users_address (user_id, type, firstname, lastname, phone)
                VALUES (:user_id, 'shipping', :firstname, :lastname, :phone);
                ", 
                [
                    'user_id' => $user_id,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'phone' => $phone,
                    'email' => $email
                ]
        );

$emailSender = new Core\EmailSender();
        
$emailSender->sendEmail(
    $email,
    'Contul tău',
    'views/emails/NewAccount.html',
    [
        'firstname' => $firstname,
        'host' => $_SERVER['HTTP_HOST']
    ]
);

$_SESSION['user'] = [
    'email' => $email,
    'name' => $firstname,
    'id' => $user_id
];

session_regenerate_id(true);
redirect('/account');