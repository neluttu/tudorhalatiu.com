<?
namespace Http\Forms;
use Core\Validator;

class UpdateAccountAddresses {
    
    protected $errors = [];

    public function validate($firstname, $lastname, $email, $phone, $city, $address, $zip, $delivery_firstname, $delivery_lastname, $delivery_phone, $delivery_city, $delivery_address, $delivery_zip) {

        if(!Validator::email($email)) $this->errors['email'] = 'Facturare: Adresa email invalidă.';
        if(!Validator::name($firstname)) $this->errors['firstname'] = 'Facturare: Prenumele este invalid.';
        if(!Validator::name($lastname)) $this->errors['lastname'] = 'Facturare: Numele este invalid.';
        if(!Validator::name($city)) $this->errors['city'] = 'Facturare: Orașul este invalid.';
        if(!Validator::string($address, 10, 50)) $this->errors['address'] = 'Facturare: Adresa de facturare invalidă.';
        if(!Validator::phone($phone)) $this->errors['phone'] = "Facturare: Număr telefon invalid.";
        if(!Validator::zip($zip)) $this->errors['zip'] = 'Facturare: Cod poștal invalid';

        if(!Validator::name($delivery_firstname)) $this->errors['delivery_firstname'] = 'Livrare: Prenumele este invalid.';
        if(!Validator::name($delivery_lastname)) $this->errors['delivery_lastname'] = 'Livrare: Numele este invalid.';
        if(!Validator::name($delivery_city)) $this->errors['delivery_city'] = 'Livrare: Orașul este invalid.';
        if(!Validator::string($delivery_address, 10, 50)) $this->errors['delivery_address'] = 'Livrare: Adresa este invalidă.';
        if(!Validator::phone($delivery_phone)) $this->errors['delivery_phone'] = 'Livrare: Telefonul este invalid.';
        if(!Validator::zip($delivery_zip)) $this->errors['delivery_zip'] = 'Livrare: Codul poștal este invalid.';

        return empty($this->errors);
    }

    public function errors() {
        return $this->errors;
    }

    public function appendError($field, $message) {
        $this->errors[$field] = $message;
    }
}