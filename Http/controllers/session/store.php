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
    if ((new Authenticator)->attempt($email, $password)) redirect('/account'); // Redirect to home page (index.php)

    // if failed login
    $form->appendError('email', 'No matching account found.');

}

Session::flash('errors', $form->errors());
Session::flash('old', [ 
                    'email' => $email
            ]);

return redirect('/login');