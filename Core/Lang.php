<?
namespace Core;

class Lang {
    protected static $langData = [];

    protected static $siteLangs = [];

    public static function loadLanguage() {

        $config = require base_path('config.php');
        self::$siteLangs = array_keys($config['siteLangs']);

        $checkURI = explode('/', rtrim(parse_url($_SERVER['REQUEST_URI'])['path'], '/'));
        unset($checkURI[0]);
        $checkURI = array_values($checkURI);
        $_SESSION['lang'] = (!empty($checkURI) and in_array($checkURI[0], self::$siteLangs)) ? $checkURI[0] : $_SESSION['lang'] = self::$siteLangs[0];
        
        self::$langData = require base_path('Lang/' . $_SESSION['lang'] . '.php');

    }

    public static function text($key) {
        $keys = explode('.', $key);
        $value = self::$langData;

        foreach ($keys as $subKey) {
            if (isset($value[$subKey])) {
                $value = $value[$subKey];
            } else {
                return $key; // Returnăm cheia originală dacă traducerea nu este găsită
            }
        }

        return $value;
    }
}
