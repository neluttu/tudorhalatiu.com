<?
namespace Core\Middleware;

class Guest {
    
    public function handle($redirect) {
        if($_SESSION['user'] ?? false) {

            header('Location: ' . $redirect ?? '/');
            exit();
        }
    }

}