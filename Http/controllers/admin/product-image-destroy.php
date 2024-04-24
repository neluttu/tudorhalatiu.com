<?

$id = $_POST['id'];
$file = $_POST['image'];

if($id and $file) {
    $imagesFiles = glob(base_path('public/images/products/'.$id.'/*.{avif}'), GLOB_BRACE);

    if(strpos($file, 'poster'))
    {
        if($imagesFiles !== false and count($imagesFiles) > 1)
            rename($imagesFiles[1], 'public/images/products/'.$id.'/poster.avif');
        else 
            unlink($imagesFiles[0]);
    }
    else 
        unlink($file);
}

redirect('/admin/product/'.$id.'#images');