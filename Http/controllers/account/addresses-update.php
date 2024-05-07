<?
use Core\App;
use Core\Database;
use Http\Forms\UpdateAccountAddresses;
use Core\Session;

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$city = $_POST['city'];
$address = $_POST['address'];
$county = $_POST['county'];
$zip = $_POST['zip'];
$delivery_firstname = $_POST['delivery_firstname'];
$delivery_lastname = $_POST['delivery_lastname'];
$delivery_phone = $_POST['delivery_phone'];
$delivery_city = $_POST['delivery_city'];
$delivery_county = $_POST['delivery_county'];
$delivery_address = $_POST['delivery_address'];
$delivery_zip = $_POST['delivery_zip'];

$form = new UpdateAccountAddresses();
if(!$form->validate($firstname, $lastname, $email, $phone, $city, $address, $zip, $delivery_firstname, $delivery_lastname, $delivery_phone, $delivery_city, $delivery_address, $delivery_zip)) {
    Session::flash('errors', $form->errors());
    redirect('/account/addresses');
    die();
}

$db = App::resolve(Database::class);
$update_billing = $db->query("UPDATE users_address SET firstname = :firstname, lastname = :lastname, county = :county, address = :address, zip = :zip, phone = :phone, city = :city, email = :email WHERE user_id = '".$_SESSION['user']['id']."' AND type = 'billing'", 
                            [
                                ':firstname' => $firstname,
                                ':lastname' => $lastname,
                                ':county' => $county,
                                ':address' => $address,
                                ':zip' => $zip,
                                ':phone' => $phone,
                                ':city' => $city,
                                ':email' => $email
                            ]);

$update_shipping = $db->query("UPDATE users_address SET firstname = :firstname, lastname = :lastname, county = :county, address = :address, zip = :zip, phone = :phone, city = :city WHERE user_id = '".$_SESSION['user']['id']."' AND type = 'shipping'", 
                            [
                                ':firstname' => $delivery_firstname,
                                ':lastname' => $delivery_lastname,
                                ':county' => $delivery_county,
                                ':address' => $delivery_address,
                                ':zip' => $delivery_zip,
                                ':phone' => $delivery_phone,
                                ':city' => $delivery_city,
                            ]);

$counties = array('Alba','Arad','Argeș','Bacău','Bihor','Bistrița-Năsăud','Botoșani','Brăila','Brașov','București','Buzău','Călărași','Caraș-Severin','Cluj','Constanța','Covasna','Dâmbovița','Dolj','Galați','Giurgiu','Gorj','Harghita','Hunedoara','Ialomița','Iași','Ilfov','Maramureș','Mehedinți','Mureș','Neamț','Olt','Prahova','Sălaj','Satu Mare','Sibiu','Suceava','Teleorman','Timiș','Tulcea','Vâlcea','Vaslui','Vrancea');

Session::flash('message', 'Datele au fost actualizate cu succes!');
redirect('/account/addresses');