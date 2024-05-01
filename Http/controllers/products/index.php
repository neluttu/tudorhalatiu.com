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
    'title' => 'Shop Tudor Halațiu',
    'description' => 'Descoperă colecția exclusivă Tudor Halațiu: top-uri elegante, rochii de seară, rochii de zi, jachete și paltoane deosebite, plus ediții limitate pentru un stil unic.'
]);