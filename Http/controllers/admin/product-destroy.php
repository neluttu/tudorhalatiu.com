<?
use Grinderspro\DirectoryManipulator\DirectoryManipulator;
use Core\App;

$product_id = $_POST['product_id'];

if((new DirectoryManipulator())->location(base_path() . 'public/images/products')->name($product_id)->delete()) {
    $db = App::resolve(Core\Database::class);
    $db->query("DELETE FROM products WHERE id = '$product_id'");
    $db->query("DELETE FROM product_views WHERE product_id = '$product_id'");
}

redirect('/admin/products');