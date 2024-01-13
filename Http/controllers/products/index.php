<?
use Core\App;

$db = App::resolve('Core\Database');

$categories = $db->query('
                        SELECT categories.*, COUNT(products.id) AS count
                        FROM categories
                        LEFT JOIN products ON categories.category_id = products.category
                        GROUP BY categories.category_id
                        ORDER BY categories.category_id ASC
                    ')->get();

view('products/index', [
    'heading' => Core\Lang::text('heading.categories'),
    'categories' => $categories,
    'title' => 'PHP OOP Products'
]);