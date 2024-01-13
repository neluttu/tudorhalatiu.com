<?
namespace Core;

use Core\App;
use Core\Database;

class Token {
    private $token = null;
    private $user = null;
    public $error = [];

    public function __construct($token = null, $user = null) {
        $this->token = $token ?? generateToken();
        $this->user = $user;
    }
    public function getToken() {
        return $this->token;
    }

    public function setToken($token) { 
        $this->token = $token;
    }

    public function checkToken() {
        $getToken = App::resolve(Database::class)
                        ->query("SELECT * from password_reset_requests WHERE token = :token AND created_at > NOW()", 
                                [
                                    'token' => $this->token
                                ])
                        ->find();
        if(!$getToken) {
            $this->error['error'] = 'Token now found.';
        }
    }
}