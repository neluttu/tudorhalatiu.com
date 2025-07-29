<?
use Core\App;

// if($_POST['name'] and $_POST['price'] and $_POST['excerpt'] and $_POST['description'] and count($_POST['sizes']) > 0)
// {
//     $updates = [
//         'maintenance_mode' => $_POST['maintenance_mode'],
//         'shop_status' => $_POST['shop_status'],
//         'contact_phone' => $_POST['contact_phone'],
//         'contact_email' => $_POST['contact_email'],
//         'shipping_tax' => $_POST['shipping_tax'],
//         'shipping_threshold' => $_POST['shipping_threshold'],
//     ];

//     $db = App::resolve(Core\Database::class);
//     $update = $db->query("UPDATE config SET maintenance_mode = :maintenance_mode, shop_status = :shop_status, contact_phone = :contact_phone, contact_email = :contact_email, shipping_tax = :shipping_tax, shipping_threshold = :shipping_threshold, sizes = :sizes, description = :description, stock = :stock, status = :status, category = :category WHERE id = :id", 
//                         [
//                             ':name' => $name,
//                             ':slug' => $slug,
//                             ':price' => $price,
//                             ':weight' => $weight,
//                             ':discount' => $discount,
//                             ':excerpt' => $excerpt,
//                             ':description' => $description,
//                             ':category' => $category,
//                             ':status' => $status,
//                             ':stock' => $stock,
//                             ':sizes' => $sizes,
//                             ':id' => $id
//                             ]
//                     );

    redirect('/admin/settings');
//}