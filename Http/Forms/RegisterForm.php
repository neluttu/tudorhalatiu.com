<?

namespace Http\Forms;

use Core\Validator;

class RegisterForm {
    
    protected $errors = [];

    public function validate($email, $password, $firstname, $lastname, $phone) {

        if(!Validator::email($email))
            $this->errors['email'] = 'invalid_email';
        
        if(!Validator::password($password))
            $this->errors['password'] = 'password_requirements';

        if(!Validator::name($firstname))
            $this->errors['firstname'] = 'invalid_username';

        if(!Validator::name($lastname))
            $this->errors['lastname'] = 'invalid_lastname';

        if(!Validator::phone($phone))
            $this->errors['phone'] = 'invalid_phone';

        return empty($this->errors);
    }

    public function errors() {
        return $this->errors;
    }

    public function appendError($field, $message) {
        $this->errors[$field] = $message;
    }


}