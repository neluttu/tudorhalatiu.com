<?php

use Core\App;
use Core\Database;
use Core\Session;


if (isset($_POST['title'], $_FILES['image'])) {
    $db = App::resolve(Database::class);

    // Validare date
    $title = trim($_POST['title']);
    $url = $_POST['url'] ? trim($_POST['url']) : '';
    $image = isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK ? $_FILES['image'] : null;

    if (empty($title) || empty($url)) {
        Session::flash('message', 'Titlul este obligatoriu.');
        return redirect('/admin/front-page-hero');
    }

    if (!$image) {
        Session::flash('message', 'Imaginea este obligatorie.');
        return redirect('/admin/front-page-hero');
    }

    // Validare imagine
    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/avif'];
    $fileType = mime_content_type($image['tmp_name']);
    $extensie = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'avif', 'webp'];

    if (!in_array($fileType, $allowedTypes) || !in_array($extensie, $allowedExtensions)) {
        Session::flash('message', 'Fișierul trebuie să fie o imagine (jpg, jpeg, png, avif, webp).');
        return redirect('/admin/front-page-hero');
    }

    if ($image['size'] > 2000000) { // Limita de 2MB
        Session::flash('message', 'Fișierul este prea mare (maxim 2MB).');
        return redirect('/admin/front-page-hero');
    }

    // Generează numele fișierului
    $fileName = uniqid('tudor-halatiu-' . strtolower(preg_replace('/[^a-zA-Z0-9-]/', '-', $title)) . '-') . '.avif';

    // Încarcă imaginea
    if (!uploadImage($image, $fileName)) {
        Session::flash('message', 'Eroare la încărcarea imaginii.');
        return redirect('/admin/front-page-hero');
    }

    // Inserează înregistrarea
    $db->query("INSERT INTO hero_image (title, url, image_url) VALUES (:title, :url, :image_url)", [
        ':title' => $title,
        ':url' => $url,
        ':image_url' => $fileName
    ]);

    Session::flash('message', 'Imaginea hero a fost adăugată cu succes.');
    return redirect('/admin/front-page-hero');
} else {
    Session::flash('message', 'Nu ai completat unul din câmpuri.');

    return redirect('/admin/front-page-hero');
}

function uploadImage($image, $fileName): bool
{
    $path = base_path('public/images/hero-images/' . $fileName);

    // Verifică dacă directorul există, dacă nu, creează-l
    $directory = dirname($path);
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
    }

    // Mută fișierul
    if (move_uploaded_file($image['tmp_name'], $path)) {
        return true;
    }

    Session::flash('message', 'Eroare la salvarea fișierului pe server.');
    return false;
}