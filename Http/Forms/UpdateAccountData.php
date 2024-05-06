<?

namespace Http\Forms;

use Core\Validator;

class UpdateAccountData {
    
    protected $errors = [];

    public function validate($password, $firstname, $lastname, $phone) {

        if($password && !Validator::password($password)) $this->errors['password'] = 'Parolă invalidă... ';

        if(!Validator::name($firstname)) $this->errors['firstname'] = 'Numele tău nu pare să fie valid...';

        if(!Validator::name($lastname)) $this->errors['lastname'] = 'Prenumele tău nu pare să fie valid...';

        if(!Validator::phone($phone)) $this->errors['phone'] = 'Număr de telefon invalid...';

        return empty($this->errors);
    }

    public function errors() {
        return $this->errors;
    }

    public function appendError($field, $message) {
        $this->errors[$field] = $message;
    }
}