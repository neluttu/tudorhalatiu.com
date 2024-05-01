<?
$Page = (isset($_SESSION['cart']) and count($_SESSION['cart']) > 0) ? 'index' : 'no-items';

use Core\Database;
use Core\Session;
use Core\App;

$counties = array('Alba','Arad','Argeș','Bacău','Bihor','Bistrița-Năsăud','Botoșani','Brăila','Brașov','București','Buzău','Călărași','Caraș-Severin','Cluj','Constanța','Covasna','Dâmbovița','Dolj','Galați','Giurgiu','Gorj','Harghita','Hunedoara','Ialomița','Iași','Ilfov','Maramureș','Mehedinți','Mureș','Neamț','Olt','Prahova','Sălaj','Satu Mare','Sibiu','Suceava','Teleorman','Timiș','Tulcea','Vâlcea','Vaslui','Vrancea');

$db = App::resolve(Database::class);

if(isset($_SESSION['user']['id'])) {

    $getBilling = $db->query('SELECT * FROM users_address WHERE user_id = :id AND type = "billing" LIMIT 1', 
                    [
                        'id' => $_SESSION['user']['id']
                    ])->find();

    $getShipping = $db->query('SELECT * FROM users_address WHERE user_id = :id AND type = "shipping" LIMIT 1', 
                    [
                        'id' => $_SESSION['user']['id']
                    ])->find();
}

view('cart/' . $Page, [
    'heading' => Core\Lang::text('heading.cart.0'),
    'heading_info' => Core\Lang::text('heading.cart.1'),
    'billing' => $getBilling ?? '',
    'shipping' => $getShipping ?? '',
    'errors' => Session::get('errors'),
    'title' => 'Coș de cumpărături',
    'description' => 'Coșul de cumpărături, haine by Tudor Halațiu',
    'counties' => $counties
]);
