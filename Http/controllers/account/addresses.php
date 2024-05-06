<?
use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$billing = $db->query("SELECT * FROM users_address WHERE user_id = '".$_SESSION['user']['id']."' AND type = 'billing'")->find();
$shipping = $db->query("SELECT * FROM users_address WHERE user_id = '".$_SESSION['user']['id']."' AND type = 'shipping'")->find();


$counties = array('Alba','Arad','Argeș','Bacău','Bihor','Bistrița-Năsăud','Botoșani','Brăila','Brașov','București','Buzău','Călărași','Caraș-Severin','Cluj','Constanța','Covasna','Dâmbovița','Dolj','Galați','Giurgiu','Gorj','Harghita','Hunedoara','Ialomița','Iași','Ilfov','Maramureș','Mehedinți','Mureș','Neamț','Olt','Prahova','Sălaj','Satu Mare','Sibiu','Suceava','Teleorman','Timiș','Tulcea','Vâlcea','Vaslui','Vrancea');

view('account/addresses', [
    'heading' => 'Adresele dvs.',
    'heading_info' => 'Folosite pentru livrare și facturare',
    'counties' => $counties,
    'billing' => $billing,
    'shipping' => $shipping,
    'errors' => Session::get('errors')
]);