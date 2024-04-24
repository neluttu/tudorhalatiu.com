<?php

$file1 = 'public/images/products/' . $_POST['id'] . '/poster.avif';
$file2 = $_POST['image'];

if (file_exists($file1) && file_exists($file2)) {
    // Generăm nume temporare pentru a face schimbul între fișiere
    $tempName1 = tempnam(sys_get_temp_dir(), 'temp1');
    $tempName2 = tempnam(sys_get_temp_dir(), 'temp2');

    // Redenumim primul fișier în numele temporar 1
    if (rename($file1, $tempName1)) {
        // Redenumim al doilea fișier în numele primului fișier original
        if (rename($file2, $file1)) {
            // Redenumim primul fișier (în numele temporar) cu numele al doilea fișier original
            if (rename($tempName1, $file2)) {
                //echo "Schimbarea numelui fișierelor a fost efectuată cu succes.";
            } else {
                // Dacă a apărut o eroare, revenim la starea inițială
                rename($file1, $tempName1); // Redenumim înapoi primul fișier
                rename($file2, $file1);     // Redenumim înapoi al doilea fișier
                //echo "Eroare la schimbarea numelui fișierelor.";
            }
        } else {
            // Dacă a apărut o eroare, revenim la starea inițială
            rename($tempName1, $file1); // Redenumim înapoi primul fișier
            //echo "Eroare la schimbarea numelui celui de-al doilea fișier.";
        }
    } else {
        //echo "Eroare la schimbarea numelui primului fișier.";
    }

    unlink($tempName1);
    unlink($tempName2);
}

redirect('/admin/product/'.$_POST['id'].'#images');