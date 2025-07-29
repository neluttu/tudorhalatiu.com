<?php
use Core\App;
use Core\Session;
use Core\Database;

$db = App::resolve(Database::class);

$hero = $db->query("SELECT * FROM hero_image LIMIT 1")->find();

view('admin/front-page-hero', [
    'heading' => 'Setări Hero Image',
    'heading_info' => 'Alege o imagine Hero pentru prima pagină a magazinului.',
    'hero' => $hero,
    'message' => Session::get('message'),
]);