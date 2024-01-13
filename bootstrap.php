<?
use Core\App;
use Core\Database;
use Core\Container;

$container = new Container();


// set new container in the Container.php class.
$container->bind('Core\Database', function () {
    $config = require base_path('config.php');
    return new Database($config['database']);

});

App::setContainer($container);