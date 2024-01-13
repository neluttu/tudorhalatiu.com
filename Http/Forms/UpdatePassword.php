<?
namespace Http\Forms;
use Core\Validator;

class UpdatePassword {
    protected $errors = [];
    public function validate($password, $password_verify) {

        if(empty($password) or empty($password_verify))
            $this->errors['empty'] = 'empty_password';

        if(!Validator::password($password))
            $this->errors['password'] = 'weak_password';

        if(!Validator::match($password, $password_verify))
            $this->errors['password_verify'] = 'password_verify';

        return empty($this->errors);
    }
    public function errors() {
        return $this->errors;
    }

    public function appendError($field, $message) {
        $this->errors[$field] = $message;
    }
}