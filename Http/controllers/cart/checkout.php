<?

use Http\Forms\CheckoutForm;
use Core\Database;
use Core\Session;
use Core\App;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];
$county = $_POST['county'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$address = $_POST['address'];
$create_account = $_POST['account-create'];
$delivery = $_POST['delivery'];
$delivery_lastname = $_POST['delivery_lastname'];
$delivery_firstname = $_POST['delivery_firstname'];
$delivery_phone = $_POST['delivery_phone'];
$delivery_city = $_POST['delivery_city'];
$delivery_county = $_POST['delivery_county'];
$delivery_address = $_POST['delivery_address'];
$delivery_zip = $_POST['delivery_zip'];

$form = new CheckoutForm();
if ($form->validate($email, $password, $firstname, $lastname, $phone, $county, $city, $zip, $address, $create_account, $delivery, $delivery_lastname, $delivery_firstname, $delivery_phone, $delivery_city, $delivery_county, $delivery_address, $delivery_zip)) {
    
    //$db = App::resolve(Database::class);

}

Session::flash('errors', $form->errors());

Session::flash('old', [ 
    'firstname' => $_POST['firstname'],
    'lastname' => $_POST['lastname'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'city' => $_POST['city'],
    'county' => $_POST['county'],
    'zip' => $_POST['zip'],
    'address' => $_POST['address'],
    'delivery_firstname' => $_POST['delivery_firstname'],
    'delivery_lastname' => $_POST['delivery_lastname'],
    'delivery_phone' => $_POST['delivery_phone'],
    'delivery_city' => $_POST['delivery_city'],
    'delivery_county' => $_POST['delivery_county'],
    'delivery_zip' => $_POST['delivery_zip'],
    'delivery_address' => $_POST['delivery_address'],
    'account-create' => $_POST['account-create'],
    'delivery' => $_POST['delivery'],
]);

return redirect('/cart');