<?
namespace Core\Middleware;

class Auth {

    public function handle($redirect) {

        if(! $_SESSION['user'] ?? false)  {
            
            header('Location: ' . $redirect ?? '/');
            exit();
        }
    }

}