<?
namespace Http\Forms;
use Core\Validator;
use Core\Lang;

class ResetForm {
    protected $errors = [];
    public function validate($email) {

        if(!Validator::email($email))
            $this->errors['invalid_email'] = 'Adresă de email invalidă';
        
        return empty($this->errors);
    }
    public function errors() {
        return $this->errors;
    }

    public function appendError($field, $message) {
        $this->errors[$field] = $message;
    }
}