<?
namespace Http\Forms;
use Core\Validator;

class UpdatePassword {
    protected $errors = [];
    public function validate($password, $password_verify) {

        if(empty($password) or empty($password_verify))
            $this->errors['empty'] = 'Câmpul trebuie completat.';

        if(!Validator::password($password))
            $this->errors['password'] = 'Alege o parolă mai puternică.';

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