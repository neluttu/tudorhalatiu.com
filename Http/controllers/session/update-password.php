<?
use Core\Session;
use Core\App;
use Core\Database;
use Http\Forms\UpdatePassword;


$form = new UpdatePassword();
$password = $_POST['password'];
$form->validate($password, $_POST['passwd']);

if($form->errors())  {
    Session::flash('errors', $form->errors());
    redirect('/set-password/' . $params['token']);
}

if($user = App::resolve(Database::class)->query("SELECT user_id FROM password_reset_requests WHERE token = :token AND expires_at > NOW() AND used = 'No'", ['token' => $params['token']])->find()) {
    // we found a matching request for the token that is still valid
    $db = App::resolve(Database::class)->query("UPDATE users SET password = :password WHERE id = '".$user['user_id']."'", [
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);
    $update = App::resolve(Database::class)->query("UPDATE password_reset_requests SET used = 'Yes' WHERE user_id = '".$user['user_id']."' AND token = :token", ['token' => $params['token']]);
        
    Session::flash('message', [ 
                        'success' => 'Your password has been set, you may now login.'
                ]);
    redirect('/login');
    die();
}



