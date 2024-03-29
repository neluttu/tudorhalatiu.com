<?
use Core\App;

if($_POST['name'] and $_POST['price'] and $_POST['excerpt'] and $_POST['description'] and count($_POST['sizes']) > 0)
{
    
    $name = $_POST['name'];
    $price = (int) $_POST['price'];
    $excerpt = $_POST['excerpt'];
    $description = $_POST['description'];
    $sizes = implode(',' , $_POST['sizes']);
    $id = $_POST['id'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    $stock = $_POST['stock'];

    $db = App::resolve(Core\Database::class);
    $update = $db->query("UPDATE products SET name = :name, price = :price, excerpt = :excerpt, sizes = :sizes, description = :description, stock = :stock, status = :status, category = :category WHERE id = :id", 
                        [
                            ':name' => $name,
                            ':price' => $price,
                            ':excerpt' => $excerpt,
                            ':description' => $description,
                            ':category' => $category,
                            ':status' => $status,
                            ':stock' => $stock,
                            ':sizes' => $sizes,
                            ':id' => $id
                            ]
                    );
    redirect('/admin/produs/'.$id);
}