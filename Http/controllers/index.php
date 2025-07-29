<?php
use Core\App;
$db = App::resolve('Core\Database');

$products = $db->query('SELECT products.*, categories.name AS category_name, categories.slug AS category_slug FROM products LEFT JOIN categories ON categories.category_id = products.category WHERE status = "Online" ORDER BY RAND() LIMIT 8')->get();

$hero = $db->query('SELECT * FROM hero_image LIMIT 1')->find();
$showcase = [
    'rich-witch-2024',
    'dirty-money-2023',
    'bad-reputation-2022'
];

view('index', [
    'products' => $products,
    'title' => 'Tudor Halațiu - creator de modă - magazin online haine',
    'description' => 'Stralucirea ta este la un click distanta. Descopera creatiile de lux semnate Tudor Halatiu, dar si reducerile sezoniere',
    'showcase' => $showcase[array_rand($showcase)],
    'hero' => $hero
]);