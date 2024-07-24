<?

use Core\Response;

function dd($value) {
    echo '<pre class="text-slate-600">';
    var_dump($value);
    echo '</pre>';
    die();
}
function d($value) {
    echo '<pre class="text-slate-600">';
    var_dump($value);
    echo '</pre>';
}

function getLangParam($uri) {
    $checkURI = explode('/', $uri);
    unset($checkURI[0]);
    return array_values($checkURI);
    
}

function getLangLinks() {
    $config = require base_path('config.php');
    $siteLangs = $config['siteLangs'];

    $LANGS = array_keys($siteLangs);
    $uri = rtrim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');

    $langParam = getLangParam($uri);
    
    if(!empty($langParam[0]) and in_array($langParam[0], $LANGS))
        $uri = substr($uri, 3);
   
    for($i=0; $i<count($LANGS);$i++) {
        // aici e eroarea cu footer link home page.
        $uri = empty($uri) ? '/' : $uri;
        
        $langs[$siteLangs[$LANGS[$i]]] = ($i !== 0) ? '/' . $LANGS[$i] . $uri : $uri;
    }
    return $langs;
}

function urlIs($value) {
    // $value = array;
    //dd(rtrim(parse_url($_SERVER['REQUEST_URI'])['path'], '/'));
    
    return $_SERVER['REQUEST_URI'] === \Core\Session::getLang() . $value;
}

// function urlIs($value) {
//     $requestUri = $_SERVER['REQUEST_URI'];
//     $langPrefix = \Core\Session::getLang();
//     $targetUri = $langPrefix . $value;
//     dd($requestUri . ' - ' . $targetUri);
    
//     if ($requestUri === $targetUri) return true;
    
//     $containsValue = strpos($requestUri, $targetUri) !== false;
//     $exactMatch = rtrim($requestUri, '/') === $targetUri;
//     return $containsValue || $exactMatch;
// }



function abort($code = 404) {
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}


function authorize($condition, $status = Response::FORBIDDEN) {
    if(!$condition) abort($status);
}

function base_path($path = '') {
    return BASE_PATH . $path;
}

function view($view, $attributes = []) {
    $attributes['nonce'] = bin2hex(random_bytes(16));
    extract($attributes);
    // Check if view exists
    if(is_file(base_path('views/' . $view . '.view.php')))
        require base_path('views/' . $view . '.view.php');
    else abort();
}

function redirect ($path = '/') {
    header('Location: ' . Core\Session::getLang() . $path);
    die();
}

function old($key, $default = '') {
    return Core\Session::get('old')[$key] ?? $default;
}


function slug($string) {
    $string = preg_replace('/[^a-z0-9-]/', '', str_replace(' ', '-', strtolower($string)));
    return $string;
}

function generateToken($length = 32) {
    $randomString = bin2hex(random_bytes($length));
    // $randomString = hash('sha256', $randomString);
    return $randomString;
}

function getPartial($partial) {
    require base_path('views/partials/'.$partial.'.php'); 
}

function limitText($text, $limit = 155) {
    $text = strip_tags($text);
    if (strlen($text) <= $limit) 
        return $text;
    else {
        $last_space = strrpos(substr($text, 0, $limit), ' ');
        return substr($text, 0, $last_space) . '...';
    }
}

function showPrice($price, $discount) {
    return $discount > 0 ? '<span class="text-gray-500 line-through">' .number_format($price, 2, ',', ''). '</span> <span>' . number_format($price - ($price * ($discount / 100)), 2, ',', '') . ' lei</span>' : number_format($price, 2, ',', '') . ' lei';
}

function getPrice($price, $discount) {
    return number_format($price - ($price * ($discount / 100)), 2, '.', '');
}

function roDate($dateTimeFromDatabase, $format = 'd m, Y') {
    $dateTime = new DateTime($dateTimeFromDatabase);
    $monthNames = [
        1 => 'ianuarie', 2 => 'februarie', 3 => 'martie', 4 => 'aprilie',
        5 => 'mai', 6 => 'iunie', 7 => 'iulie', 8 => 'august',
        9 => 'septembrie', 10 => 'octombrie', 11 => 'noiembrie', 12 => 'decembrie'
    ];
    return str_replace(['d', 'm', 'Y'], [$dateTime->format('j'), $monthNames[(int) $dateTime->format('n')], $dateTime->format('Y')], $format);
}

function decrypt($encrypted, $key = '7c952ebc1a6a529e0baadc6368d5ffec') 
    {
        $encrypted = (string)$encrypted;
        if(!strlen($encrypted)) {
            return null;
        }
        if(strpos($encrypted, ',') !== false) {
            $encryptedParts = explode(',', $encrypted, 2);
            $iv = base64_decode($encryptedParts[0]);
            if (false === $iv) {
                throw new Exception("Invalid encryption iv");
            }
            $encrypted = base64_decode($encryptedParts[1]);
            if (false === $encrypted) {
                throw new Exception("Invalid encrypted data");
            }
            $decrypted = openssl_decrypt($encrypted, "aes-256-cbc", $key, OPENSSL_RAW_DATA, $iv);
            if (false === $decrypted) {
                throw new Exception("Data could not be decrypted");
            }
            return $decrypted;	
        }
    return null;   
    }

    function calculateShippingTax($cart = true) {
        $amount = 0;
        $weight = 0;

        if($cart and count($_SESSION['cart']) > 0) {
                foreach($_SESSION['cart'] as $key => $product) {
                    $amount +=  getPrice($product['price'],$product['discount']);
                    $weight += $product['weight'];
                }
        }

        if($amount < $GLOBALS['conf']['shipping_threshold']) {
            if($weight <= 3)
                // return default tax;
                return $GLOBALS['conf']['shipping_tax'];
            else 
                // Default tax + ($GLOBALS['conf']['shipping_tax'] - 3kgs. Add 2 RON for each extra kg.)
                return $GLOBALS['conf']['shipping_tax'] + (($GLOBALS['conf']['shipping_tax'] - 3) * 2);
        }
        else 
            return 0;
    }

    