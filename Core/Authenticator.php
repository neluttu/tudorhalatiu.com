<?

namespace Core;

use Core\Session;

class Authenticator {

    public function attempt($email, $password) {

        $userData = App::resolve(Database::class)->query("SELECT * FROM users WHERE email = :email",[
            'email' => $email])->find();


        if($userData) {

            if(password_verify($password, $userData['password'])) {
                $this->login([
                    'email' => $email,
                    'name' => $userData['firstname'],
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
            'id' => $userData['id']
        ];
    
        session_regenerate_id(true);
    
    }

    // public function logout() {

    //     Session::destroy();
    // }
    
}