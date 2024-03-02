<?
use Core\Authenticator;
use Http\Forms\LoginForm;
use Core\Session;

$heading = 'Your account';

// Get user submitted data.
$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

// Validate username and password
if ($form->validate($email, $password)) {

    // Authorize user
    if ((new Authenticator)->attempt($email, $password)) 
        if($_SERVER['REQUEST_URI'] == '/cart-login') redirect('/cart');
            else $_SESSION['user']['role'] == 'admin' ? redirect('/admin') : redirect('/account');

    // if failed login
    $form->appendError('email', 'Adresa de email sau parola este greșită.');

}

Session::flash('errors', $form->errors());
Session::flash('old', [ 
                    'email' => $email
            ]);

if($_SERVER['REQUEST_URI'] == '/cart-login') return redirect('/cart');
else return redirect('/login');