<?
return [
    'userForms' => [
        'empty_password' => 'Câmpul cu parola nu poate să fie gol.',
        'weak_password' => 'Parola introdusă trebuie să conțină măcar o literă MARE, un număr și un caracter speci@l.',
        'password_verify' => 'Parola de verificare nu corespunde cu parola aleasă.',
        'invalid_email' => 'Te rugăm introdu o adresă de email corectă.',
        'null_user' => 'Acest utilizator nu există.',
        'reset_token_valid' => 'Am trimis deja un email de resetare parolă. Poți cere altul în aproximativ :minutes minute.',
        'reset_success' => 'Ți-am trimis un email cu un link pentru a reseta parola contului tău.'
    ],
    'product' => [
        'price' => 'Preț',
        'quantity' => 'Cantitate',
        'add_to_cart' => 'Adaugă în coș',
        'added_to_cart' => 'Produsul a fost adăugat în <a href="'.\Core\Session::getLang().'/cart" class="underline">coșul de cumăpărături!</a>',
        'already_in_cart' => 'Produsul există deja în coșul de cumpărături. Vezi <a href="'.\Core\Session::getLang().'/cart" class="underline">coșul</a> pentru a-i modifica cantitatea dacă dorești.',
        'update_cart_item' => 'Șterge',
        'checkout_button' => 'Plătește',
        'cart_remove_option' => 'Șterge',
        'quantity_updated' => 'Cantitate modificată pentru <b>:product</b>.',
        'cart_empty' => 'Nu există produse în coșul de cumpărături.',
        'product_not_found' => 'Produsul ales nu există.',
        'product_removed' => 'Produsul <b>:product</b> a fost șters din coș.',
        
    ],
    'nav' => [
        'home' => 'Acasă',
        'about' => 'Despre',
        'contact' => 'Contact',
        'notes' => 'Notițe',
        'products' => 'Produse',
        'admin' => 'Site Admin'
    ],
    'heading' => [
        'categories' => ['Cumpără online', 'Text categorii produse'],
        'contact' => ['Informații contact', 'Cum poți lua legătura cu mine'],
        'about' => ['Tudor Halațiu', 'Text pagina despre'],
        'cart' => ['coș de cumpărături', 'Verifică și finalizează cumpărăturile'],
        'register' => ['Crează un cont în magazin', 'Ține evidența comenzilor și a produselor favorite'],
        'login' => ['Autentifică-te în magazin', 'Accesează contul tău de client']
    ],
    'header' => [
        'title' => 'Tudor Halatiu - ',
        'keywords' => 'php, oop, mysql',
        'description' => 'website description'
    ]
];