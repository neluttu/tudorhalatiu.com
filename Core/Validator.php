<?
namespace Core;
class Validator { 

    public static function string($value, $min = 1, $max = INF) : bool {

        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <= $max;

    }

    public static function email(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function match($password, $password_verify) {
        return $password === $password_verify;
    }

    public static function password($password) : bool 
    {
        if(!self::string($password, 1, 100)) return false;

        if (!(strlen($password) >= 10 && strlen($password) <= 11)) 
            return false;

        if (!preg_match('/[A-Z]/', $password))
            return false;
    
        if (!preg_match('/[0-9]/', $password))
            return false;
    
        if (!preg_match('/[^A-Za-z0-9]/', $password))
            return false;
    
        return true;        
    }

    public static function phone($phoneNumber) : bool {
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);
    
        if (strlen($phoneNumber) >= 10 && strlen($phoneNumber) <= 11) 
            if (ctype_digit($phoneNumber)) 
                return true;

        return false;
    }    

    public static function name($name, $min = 1, $max = 100) : bool {
        //dd(strlen($name) >= $min && strlen($name) <= $max);
        if (strlen($name) >= $min && strlen($name) <= $max)
            return (preg_match('/^[A-Za-z\-\. ]+$/', trim($name))) ? true : false;
        else return false;
    }
}