<?
use Core\App;

if($_POST['name'] and $_POST['text'] and $_POST['id'])
{
    
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $text = $_POST['text'];
    $category_id = $_POST['id'];

    $db = App::resolve(Core\Database::class);
    $update = $db->query("UPDATE categories SET name = :name, text = :text WHERE category_id = :id", 
                        [
                            ':name' => $name,
                            // ':slug' => $slug,
                            ':text' => $text,
                            ':id' => $category_id
                            ]
                    );

    redirect('/admin/categories');
}
redirect('/admin/categories');