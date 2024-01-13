<?
use Core\Session;
use Core\App;
use Core\Database;

// check if token exists in url, has 64 chars and the token exists in the database.
if(isset($params['token']) && strlen($params['token']) === 64 and App::resolve(Database::class)->query("SELECT token, expires_at FROM password_reset_requests WHERE token = :token AND expires_at > NOW() AND used = 'No'", ['token' => $params['token']])->find())
{
    view('session/set-password', [
        'heading' => 'Create new password',
        'errors' => Session::get('errors'),
        'params' => $params
    ]);
}
else redirect('/reset-password');