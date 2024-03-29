<?
namespace Http\Forms;

use Core\Validator;

class LoginForm {

    protected $errors = [];

    public function validate($email, $password) {

        if(!Validator::email($email))
            $this->errors['email'] = 'Adresă de email invalidă.';
        
        if(!Validator::string($password, 7, 255))
            $this->errors['password'] = 'password_verify';

        return empty($this->errors);
    }
    public function errors() {
        return $this->errors;
    }

    public function appendError($field, $message) {
        $this->errors[$field] = $message;
    }
}