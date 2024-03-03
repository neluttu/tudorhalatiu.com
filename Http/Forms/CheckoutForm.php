<?

namespace Http\Forms;

use Core\Validator;
use Core\Database;
use Core\App;

class CheckoutForm {
    
    protected $errors = [];

    public function validate($email, $password, $firstname, $lastname, $phone, $county, $city, $zip, $address, $create_account, $delivery, $delivery_lastname, $delivery_firstname, $delivery_phone, $delivery_city, $delivery_county, $delivery_address, $delivery_zip) {

        if($delivery) {
            if(!Validator::name($delivery_firstname))
            $this->errors['delivery_firstname'] = 'invalid_username';

            if(!Validator::name($delivery_lastname))
                $this->errors['delivery_lastname'] = 'invalid_lastname';

            if(!Validator::phone($delivery_phone))
                $this->errors['delivery_phone'] = 'invalid_phone';

            if(!Validator::string($delivery_county))
                $this->errors['delivery_county'] = 'invalid_county';

            if(!Validator::string($delivery_city))
                $this->errors['delivery_city'] = 'invalid_city';

            if(!Validator::string($delivery_zip))
                $this->errors['delivery_zip'] = 'invalid_zip';

            if(!Validator::string($delivery_address))
                $this->errors['delivery_address'] = 'invalid_address';
        }

        if(!Validator::email($email)) 
            $this->errors['cart_email'] = 'Adresa de email este invalidă.';

        $db = App::resolve(Database::class);
        if(/* $create_account and */ $db->query('SELECT email FROM users WHERE email = :email',  ['email' => $email])->find())
            $this->errors['cart_email'] = 'Acest email este deja înregistrat. <a href="/login" title="Autentificare Client TudorHalatiu.com">Autentificare în cont.</a>';

        
        if($create_account) {
            if(!Validator::password($password))
                    $this->errors['password'] = true;
        }

        if(!Validator::name($firstname))
            $this->errors['firstname'] = 'invalid_username';

        if(!Validator::name($lastname))
            $this->errors['lastname'] = 'invalid_lastname';

        if(!Validator::phone($phone))
            $this->errors['phone'] = 'invalid_phone';

        if(!Validator::string($county))
            $this->errors['county'] = 'invalid_county';

        if(!Validator::string($city))
            $this->errors['city'] = 'invalid_city';

        if(!Validator::string($zip))
            $this->errors['zip'] = 'invalid_zip';

        if(!Validator::string($address))
            $this->errors['address'] = 'invalid_address';

        return empty($this->errors);
    }

    public function errors() {
        return $this->errors;
    }

    public function appendError($field, $message) {
        $this->errors[$field] = $message;
    }


}