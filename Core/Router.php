<?
namespace Core;

use Core\Middleware\Middleware;

class Router {
    protected $routes = [];
    protected $config;

    public function __construct() {
        $this->config = require base_path('config.php');
        define('LANGS', array_keys($this->config['siteLangs']));
    }


    protected function add($method, $uri, $controller) {
        
        //$this->routes[] = compact('method', 'uri', 'controller'); same as:
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null,
            'redirect' => null
        ];

        return $this;
    }

    public function get($uri, $controller) {
        $this->add('GET', $uri, $controller);
        return $this;
    }
    
    public function post($uri, $controller) {
        $this->add('POST', $uri, $controller);
        return $this;
    }

    public function delete($uri, $controller) {
        $this->add('DELETE', $uri, $controller);
        return $this;
    }

    public function patch($uri, $controller) {
        $this->add('PATCH', $uri, $controller);
        return $this;
    }

    public function put($uri, $controller) {
        $this->add('PUT', $uri, $controller);
        return $this;
    }

    // grab the last added route and add the middleware key.
    public function only($key, $redirect = null) {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
        $this->routes[array_key_last($this->routes)]['redirect'] = $redirect;
        return $this;
    }

    public function route() {
        
        $uri = rtrim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');
        $method = strtoupper($_POST['_method'] ?? $_SERVER['REQUEST_METHOD']);

        // Check if language is set
        $checkURI = explode('/', $uri);
        unset($checkURI[0]);
        $checkURI = array_values($checkURI);
        // Here we have the first URI partial.

        if(!empty($checkURI) and in_array($checkURI[0], LANGS)) $urlLang = true;
        else $urlLang = false;
        
        if(!$urlLang) $uri = '/' . $_SESSION['lang'] . $uri;

        foreach($this->routes as $route) {
            $routeSegments = explode('/', trim($route['uri'], '/'));
            $uriSegments = explode('/', trim($uri, '/'));
            $match = true;

            if(count($uriSegments) === count($routeSegments) and $route['method'] === $method) {
                $params = [];
                $match = true;
              
                for($i = 0; $i < count($uriSegments); $i++) { 
                    if($routeSegments[$i] !== $uriSegments[$i] and !preg_match('/\{(.+?)\}/', $routeSegments[$i])){
                        $match = false;
                        break;
                    }
                    if(preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches))
                        $params[$matches[1]] = $uriSegments[$i];
                }
                if($match) {
                    Middleware::resolve($route['middleware'], $route['redirect']);    
                    return require base_path('Http/controllers/' . $route['controller']);
                }
            }
        }
        $this->abort();
    }

    protected function abort($code = 404) {
        http_response_code($code);
        require base_path("views/{$code}.php");
    }
}