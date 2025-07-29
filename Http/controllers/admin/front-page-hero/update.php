<?php

use Core\App;
use Core\Database;
use Core\Session;

if (isset($_POST['title']) && isset($_FILES['image'])) {

    $db = App::resolve(Database::class);

    $getCurrentImage = $db->query("SELECT * FROM hero_image WHERE id = :id LIMIT 1", [
        ':id' => $_POST['id']
    ])->find();

    $title = $_POST['title'];
    $url = $_POST['url'] ? trim($_POST['url']) : '';
    $image = !empty($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE ? $_FILES['image'] : null;

    $fileName =
        $image
        ? uniqid('tudor-halatiu-' . strtolower(str_replace(' ', '-', $title)) . '-') . '.avif'
        : $getCurrentImage['image_url'];

    $insert = $db->query('UPDATE hero_image SET title = :title, image_url = :image_url, url = :url WHERE id = :id', [
        ':title' => $title,
        ':image_url' => $fileName,
        ':url' => $url,
        ':id' => $_POST['id']
    ]);

    if ($image)
        uploadImage($fileName);

    Session::flash('message', 'Imaginea hero a fost adaugată cu succes.');
    return redirect('/admin/front-page-hero');

} else {
    Session::flash('message', 'Nu ai completat unul din câmpuri.');
    return redirect('/admin/front-page-hero');
}



function uploadImage($fileName)
{
    $hero_image = $_FILES['image'];

    if ($hero_image['error'] !== UPLOAD_ERR_OK) {
        Session::flash('upload_error', 'Eroare la încărcarea fișierului...');
    }

    // Verifică tipul fișierului
    $tip = mime_content_type($hero_image['tmp_name']);
    if (substr($tip, 0, 5) !== 'image') {
        Session::flash('upload_error', 'Fișierul nu este o imagine validă...');
    }

    // Verifică extensia fișierului
    $extensie = pathinfo($hero_image['name'], PATHINFO_EXTENSION);
    if ($extensie !== 'jpg' || $extensie !== 'avif' || $extensie !== 'jpeg') {
        Session::flash('upload_error', 'Extensia trebuie să fie jpg, avif sau jpeg');
    }

    // Salvează imaginea pe server
    $path = base_path('public/images/hero-images/' . $fileName);
    if (!move_uploaded_file($hero_image['tmp_name'], $path)) {
        Session::flash('upload_error', 'Eroare la salvarea fișierului pe server...');
    }
}