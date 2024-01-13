<?
return [
    'userForms' => [
        'empty_password' => 'Password field cannot be empty...',
        'weak_password' => 'Your password musc contain at least one UPPERCASE  letter, one number and one speci@l character',
        'password_verify' => 'Your passwords do not match.',
        'invalid_email' => 'Your email address seems to be invalid...',
        'null_user' => 'This username does not exist',
        'reset_token_valid' => 'We\'ve already sent a reset password link. You can request another one in about :minutes minutes.',
        'reset_success' => 'We\'ve sent you a email with a password reset link.'
    ],
    'product' => [
        'price' => 'Price',
        'quantity' => 'Quantity',
        'add_to_cart' => 'Add to cart',
        'added_to_cart' => 'Product added to your <a href="'.\Core\Session::getLang().'/cart" class="underline">shopping cart!</a>',
        'already_in_cart' => 'Product already in cart, visit <a href="'.\Core\Session::getLang().'/cart" class="underline">your cart</a> to update the quantity if desired.',
        'update_cart_item' => 'Update',
        'checkout_button' => 'Checkout',
        'cart_remove_option' => 'Remove',
        'quantity_updated' => 'Quantity updated for <b>:product</b>.',
        'cart_empty' => 'There are no products in your shopping cart.',
        'product_not_found' => 'Product not found.'
    ],
    'nav' => [
        'home' => 'Home',
        'about' => 'About',
        'contact' => 'Contact',
        'notes' => 'Notes',
        'products' => 'Products'
    ],
    'heading' => [
        'categories' => 'Product categories',
        'contact' => 'Pagină de contact',
        'about' => 'Despre noi',
        'notes' => 'Notițele tale',
    ]

];