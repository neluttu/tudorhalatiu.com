<?
use Core\App;
use Core\Database;

$token = $params['token'];
$invoice = BASE_PATH . 'public/invoices/blank.pdf';

if(strlen($token) === 32 and is_file($invoice)) {
    $db = App::resolve(Database::class);

    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . basename($invoice) . '"');
    header('Content-Length: ' . filesize($invoice));

    readfile($invoice);
    exit;

}


//     $invoice = __DIR__ . '/public/invoices/' . $matches[1] . '.pdf';

//     // Verificăm dacă fișierul există
//     if (file_exists($invoice)) {
//         // Setăm header-ele pentru a livra PDF-ul
//         header('Content-Type: application/pdf');
//         header('Content-Disposition: inline; filename="' . basename($invoice) . '"');
//         header('Content-Length: ' . filesize($invoice));

//         // Citim și livrăm fișierul
//         readfile($invoice);
//         exit;
//     } else {
//         // Fișierul nu există, returnăm 404
//         header("HTTP/1.0 404 Not Found");
//         echo "404 - Document not found.";
//         exit;
//     }
