<?php

namespace Core;

class Session {
    public static function put($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null) {
        return $_SESSION['_flashed'][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function has($key) {
        return static::get($key);
    }

    public static function getLang() { 
        if($_SESSION['lang'] == 'ro') $uriLang = '';
        else $uriLang = '/' . $_SESSION['lang'];
        return $uriLang;
    }

    public static function isAdmin() {
        return (isset($_SESSION['user']['role']) and $_SESSION['user']['role'] === 'admin') ? true : false;
    }

    public static function flash($key, $value) {
        $_SESSION['_flashed'][$key] = $value;
    }

    public static function unflash() {
        unset($_SESSION['_flashed']);
    }

    public static function flush() {
        $_SESSION['user'] = [];
    }

    public static function getMessage() {
        // Get cart action message.
        if(isset($_SESSION['_flashed']['cart_message']['result'])) 
            return require base_path('views/partials/result-message.php');
    }

    public static function destroy() {

        self::flush();

        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID','', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}