<?
namespace Core\Middleware;

class Admin {

    public function handle($redirect) {

        if(!($_SESSION['user'] and $_SESSION['user']['role'] == 'admin') ?? false)  {
            
            header('Location: ' . $redirect ?? '/admin');
            exit();
        }
    }

}