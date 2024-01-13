<?
namespace Core\Middleware;

class Middleware {

    const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class
    ];

    public static function resolve($key, $redirect) {
        if(!$key) return;

        $middleware = static::MAP[$key] ?? false;
//        dd($middleware);
        if(!$middleware) {
            // Daca middleware nu exista, adica nu este egal cu 'guest' sau 'auth'
            throw new \Exception('No middleware found for key <b>' . $key .'</b>.');
        }

        // altfel, continua scriptul.
        (new $middleware)->handle($redirect);
    }

}