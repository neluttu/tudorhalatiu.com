<?
use Core\Token;
use Core\Session;
use Core\App;
use Core\Database;
use Core\Lang;
require base_path('Lang/' . Session::has('lang') .'.php');    

$form = new Http\Forms\ResetForm();
$email = $_POST['email'];

// Dev unset token request.
//unset($_SESSION['token'],$_SESSION['token_expires']);
$form->validate($email);

if(Session::has('token') and Session::has('token_expires') > time() and empty($form->errors())) {
    Session::flash('message', 
                        [
                            'success' => str_replace(':minutes', round(abs($_SESSION['token_expires'] - time()) / 60), Lang::text('userForms.reset_token_valid'))
                        ]);
    return redirect('/login');
} else unset($_SESSION['token'],$_SESSION['token_expires']);


if (!($user = App::resolve(Database::class)
    ->query("SELECT id, email, token, expires_at, used FROM users LEFT JOIN password_reset_requests ON password_reset_requests.user_id = users.id WHERE email = :email ORDER BY request_id DESC", ['email' => $email])
    ->find()) and empty($form->errors()))
        $form->appendError('null_user', Lang::text('userForms.null_user'));

// Check if token exists or not and recovery is possible.
$active_token = $user['token'] ? (strtotime($user['expires_at']) < time() ? false : true) : false;

if($active_token and $user['used'] == 'No') {
    $form->appendError('reset_active',  str_replace(':minutes', round(abs(strtotime($user['expires_at']) - time()) / 60), Lang::text('userForms.reset_token_valid')));
}

if(empty($form->errors())) {
        $token = new Token();
        $store = App::resolve(Database::class)->query("INSERT INTO password_reset_requests (user_id, token, expires_at) VALUES ('".$user['id']."', '" . $token->getToken() . "', DATE_ADD(NOW(), INTERVAL 5 MINUTE))");
        // send email with token link.

        $emailSender = new Core\EmailSender();
        
        $emailSender->sendEmail(
            $user['email'],
            'Password reset',
            '../views/emails/ResetPasswordLink.html',
            ['name' => 'Neluttu',  'key' => $token->getToken()]
        );
                
        // flash message and redirect to success page.
        Session::flash('message', ['success' => Lang::text('userForms.reset_success')]);
        Session::put('token', $token->getToken());
        Session::put('token_expires', strtotime("+5 minutes"));
        return redirect('/login');
}

Session::flash('errors', $form->errors());
Session::flash('old', [ 
                    'email' => $email
            ]);

return redirect('/reset-password');