<?php
use Core\App;
use Core\Database;

$token = $params['token'];
$invoice = BASE_PATH . 'public/invoices/' . $token . '.pdf';

if (strlen($token) === 32 && is_file($invoice)) {

    $db = App::resolve(Database::class);
    $order = $db->query("SELECT id FROM orders WHERE token = :token", [
        ':token' => $token
    ])->findOrFail();

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($invoice) . '"');
        header('Content-Length: ' . filesize($invoice));
        readfile($invoice);
        exit;
}
abort();