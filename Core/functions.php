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
    extract($attributes);
    // fail require needs fallback.
    require base_path('views/' . $view . '.view.php');
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

function printDescription($description) {
    $description = str_replace('[a href','<a href',$description);
    $description = str_replace('[/a]','</a>',$description);
    return nl2br($description);

}