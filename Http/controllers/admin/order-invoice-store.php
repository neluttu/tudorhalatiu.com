<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['invoice'])) {
    $token = $_POST['token'];
    $file = $_FILES['invoice']; 
    $order_id = $_POST['order_id'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileName = $token . '.pdf';
        $targetFile = BASE_PATH . 'public/invoices/' . $fileName;

        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        if ($fileExtension !== 'pdf') {
            $errors['pdf'] = 'Fișierul nu este PDF.';
        }

        if ($file['size'] > 10 * 1024 * 1024) {
            $errors['size'] = 'File size exceeds the maximum allowed size of 10MB.';
        }

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            redirect('/admin/order/' . $order_id);
        } else {
            $errors['pdf_upload'] = 'Failed to move uploaded file.';
        }
    } else {
        redirect('/admin/order/' . $order_id);
    }
} else {
    abort();
}
