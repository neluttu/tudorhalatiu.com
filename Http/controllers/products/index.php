<?
use Core\App;

$db = App::resolve('Core\Database');

$categories = $db->query('
                        SELECT categories.*, COUNT(products.id) AS count
                        FROM categories
                        LEFT JOIN products ON categories.category_id = products.category
                        WHERE products.status = "Online"
                        GROUP BY categories.category_id
                        ORDER BY categories.category_id ASC
                    ')->get();

view('products/index', [
    'heading' => Core\Lang::text('heading.categories.0'),
    'heading_info' => Core\Lang::text('heading.categories.1'),
    'categories' => $categories,
    'title' => 'Magazin online cu item-uri by Tudor Halațiu',
    'description' => 'Descopera categoriile din magazinul online, dar si colectiile exclusive de rochii de seara, rochii de zi, topuri si multe altele,semnate Tudor Halatiu, pentru momentul tau de stralucire'
]);