<?php
use Core\App;
use Core\Database;
use Core\Session;

if ($_POST['id'] && $_POST['_method'] === 'delete') {

    $db = App::resolve(Database::class);

    $image = $db->query("SELECT image_url FROM hero_image WHERE id = :id LIMIT 1", [':id' => $_POST['id']])->find();
    if ($image) {
        $imagePath = base_path('public/images/hero-images/' . $image['image_url']);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    $delete = $db->query('DELETE FROM hero_image WHERE id = :id', [':id' => $_POST['id']]);

    Session::flash('message', 'Imaginea hero a fost ștearsă cu succes.');
    return redirect('/admin/front-page-hero');
}