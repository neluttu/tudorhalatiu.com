<?
namespace Core;

use Core\Session;

class Authenticator {

    public function attempt($email, $password) {

        ;

        if($userData = App::resolve(Database::class)->query("SELECT * FROM users LEFT JOIN users_data ON users_data.user_id = users.id WHERE email = :email AND status = 'Active'", [
            'email' => $email])->find()) {

            if(password_verify($password, $userData['password'])) {
                $this->login([
                    'email' => $email,
                    'name' => $userData['firstname'],
                    'role' => $userData['role'],
                    'id' => $userData['id'],
                ]);
                return true;
            }
            
        }
        else return false;
    }


    public function login($userData) {
        $_SESSION['user'] = [
            'email' => $userData['email'],
            'name' => $userData['name'],
            'role' => $userData['role'],
            'id' => $userData['id']
        ];
    
        //session_regenerate_id(true);
    }

    // public function logout() {

    //     Session::destroy();
    // }
    
}