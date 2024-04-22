<?
use Core\Session;
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$product = $db->query("SELECT name FROM products WHERE id = :id", [":id" => $_POST['id']])->find();

if(isset($_FILES['image'])) {
    $fisier = $_FILES['image'];

    if ($fisier['error'] !== UPLOAD_ERR_OK) {
        Session::flash('upload_error', 'Eroare la încărcarea fișierului...');
    }

    // Verifică tipul fișierului
    $tip = mime_content_type($fisier['tmp_name']);
    if (substr($tip, 0, 5) !== 'image') {
        Session::flash('upload_error', 'Fișierul nu este o imagine validă...');
    }

    // Verifică extensia fișierului
    $extensie = pathinfo($fisier['name'], PATHINFO_EXTENSION);
    if ($extensie !== 'jpg' || $extensie !== 'avif' || $extensie !== 'jpeg') {
        Session::flash('upload_error', 'Extensia trebuie să fie jpg, avif sau jpeg');
    }

    // Verifică dimensiunea fișierului (maxim 500KB)
    if ($fisier['size'] > 500 * 1024) { // 500KB exprimat în bytes
        Session::flash('upload_error', 'Fișierul încărcat este prea mare, maxim 500kb');
    }
    if(!is_file(base_path('public/images/products/' . $_POST['id'] .'/poster.avif')))
        $fileName = 'poster.avif';
    else $fileName = uniqid('tudor-halatiu-' . strtolower(str_replace(' ','-',$product['name'])) . '-') . '.avif';

    // Salvează imaginea pe server
    $path = base_path('public/images/products/'.$_POST['id'].'/' . $fileName);
    if (!move_uploaded_file($fisier['tmp_name'], $path)) {
        Session::flash('upload_error', 'Eroare la salvarea fiȘierului pe server...');
    }
} 

redirect('/admin/product/' . $_POST['id']);