<?
namespace Http\Forms;
use Core\Validator;
class AddProduct {
    
    protected $errors = [];

    public function validate($name, $price, $excerpt, $description) {

        if(!Validator::string($name, $min = 10, $max = 100))
            $this->errors['name'] = 'Nume invalid';

        if(!Validator::string($excerpt, $min = 10, $max = 200))
            $this->errors['excerpt'] = 'Rezumatul este invalid';

        if(!Validator::string($description, $min = 10, $max = 2000))
            $this->errors['description'] = 'Descrierea este invalida';

        return empty($this->errors);
    }

    public function errors() {
        return $this->errors;
    }

    public function appendError($field, $message) {
        $this->errors[$field] = $message;
    }
}