<?

namespace Core;

class Container {

    protected $bindings = [];

    // add something    to the container
    public function bind($key, $function) {

        $this->bindings[$key] = $function;
    }

    // remove something from the container
    public function resolve($key) {

        if(!array_key_exists($key, $this->bindings)) 
            throw new \Exception('Binding not found.');

        $resolver = $this->bindings[$key];
        return call_user_func($resolver);
    }    
}