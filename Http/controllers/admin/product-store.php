<?
use Core\App;
use Http\Forms\AddProduct;
use Core\Session;
use Grinderspro\DirectoryManipulator\DirectoryManipulator;

$name = $_POST['name'];
$price = $_POST['price'];
$sizes = $_POST['sizes'];
$category = $_POST['category'];
$stock = $_POST['stock'];
$status = $_POST['status'];
$excerpt = $_POST['excerpt'];
$description = $_POST['description'];

$form = new AddProduct();

$db = App::resolve(Core\Database::class);

if(!$form->validate($name, $price, $excerpt, $description)) {

    Session::flash('errors', $form->errors());
    Session::flash('old', [ 
        'name' => $name,
        'price' => $price,
        'sizes' => $sizes,
        'category2' => $category,
        'stock' => $stock,
        'status' => $status,
        'excerpt' => $excerpt,
        'description' => $description,
        ]);    
        
    redirect ('/admin/product/add');
    die();
}

$db->query("
        INSERT INTO products (category, name, sizes, price, excerpt, description, stock, status)
        VALUES (:category, :name, :sizes, :price, :excerpt, :description, :stock, :status)
        ", 
        [
            'category' => $category,
            'name' => $name,
            'sizes' => implode(',', $sizes),
            'price' => $price,
            'excerpt' => $excerpt,
            'description' => $description,
            'stock' => $stock,
            'status' => $status,
        ]
    );
$product_id = $db->getLastID();
$addView = $db->query("INSERT INTO product_views (id) VALUES (:id)", [':id' => $product_id]);

// Make folder for current product.
(new DirectoryManipulator())->location(base_path() . '/public/images/products')->name($product_id)->create();
// Update folder permissions
@chmod(base_path() . '/public/images/products/' . $product_id, 0777);

redirect('/admin/product/' . $product_id);