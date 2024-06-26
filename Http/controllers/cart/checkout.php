<?
use Http\Forms\CheckoutForm;
use Core\Database;
use Core\Session;
use Core\App;

$email = $_POST['email'];
$password = isset($_POST['password']) ? $_POST['password'] : false;

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];
$county = $_POST['county'];
$country = $_POST['country'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$address = $_POST['address'];

$payment = $_POST['payment'];

$create_account = isset($_POST['account-create']) ? true : false;
$delivery = isset($_POST['delivery']) ? true : false;

$delivery_lastname = $delivery ? $_POST['delivery_lastname'] : $_POST['lastname'];
$delivery_firstname = $delivery ? $_POST['delivery_firstname'] : $_POST['firstname'];
$delivery_phone = $delivery ? $_POST['delivery_phone'] : $_POST['phone'];
$delivery_city = $delivery ? $_POST['delivery_city'] : $_POST['city'];
$delivery_county = $delivery ? $_POST['delivery_county'] : $_POST['county'];
$delivery_country = $delivery ? $_POST['delivery_country'] : $_POST['country'];
$delivery_address = $delivery ? $_POST['delivery_address'] : $_POST['address'];
$delivery_zip = $delivery ? $_POST['delivery_zip'] : $_POST['zip'];

$form = new CheckoutForm();

if ($form->validate($email, $password, $firstname, $lastname, $phone, $county, $city, $zip, $address, $create_account, $delivery, $delivery_lastname, $delivery_firstname, $delivery_phone, $delivery_city, $delivery_county, $delivery_address, $delivery_zip)) {
    
    $db = App::resolve(Database::class);
    if($create_account and !isset($_SESSION['user']['email'])) {

    // add user to database
    $db->query("
            INSERT INTO users (email, password, status, remote_addr)
            VALUES (:email, :password, 'Active', INET_ATON(:ipAddress))
            ", [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'ipAddress' => $_SERVER['REMOTE_ADDR'],
            ]
        );

    // get new user ID
    $user_id = $db->getLastID();


    $db->query("
            INSERT INTO users_data (user_id, firstname, lastname, phone)
            VALUES (:user_id, :firstname, :lastname, :phone)
            ", [
                'user_id' => $user_id,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'phone' => $phone,
            ]
        );

        // Insert user account billing addresse into db.
        $db->query("
                    INSERT INTO users_address (user_id, type, firstname, lastname, country, address, city, county, zip, phone, email)
                    VALUES (:user_id, 'billing', :firstname, :lastname, :country, :address, :city, :county, :zip, :phone, :email)
                ", [
                    'user_id' => $user_id,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'country' => $country,
                    'address' => $address,
                    'city' => $city,
                    'county' => $county,
                    'zip' => $zip,
                    'phone' => $phone,
                    'email' => $email
                ]
            );

        // Insert user account delivery addresse into db.
        if($delivery) 
            $db->query("
                    INSERT INTO users_address (user_id, type, firstname, lastname, country, address, city, county, zip, phone)
                    VALUES (:user_id, 'shipping', :firstname, :lastname, :country, :address, :city, :county, :zip, :phone)
                ", [
                    'user_id' => $user_id,
                    'firstname' => $delivery_firstname,
                    'lastname' => $delivery_lastname,
                    'country' => $delivery_country,
                    'address' => $delivery_address,
                    'city' => $delivery_city,
                    'county' => $delivery_county,
                    'zip' => $delivery_zip,
                    'phone' => $delivery_phone
                ]
            );

        $emailSender = new Core\EmailSender();
        
        $emailSender->sendEmail(
            $email,
            'Contul tău',
            'views/emails/NewAccount.html',
            [
                'firstname' => $firstname,
                'host' => $_SERVER['HTTP_HOST']
            ]
        );
        
        // Log the user in.
        $_SESSION['user'] = [
            'email' => $email,
            'name' => $firstname,
            'id' => $user_id
        ];
        
        session_regenerate_id(true);
    }
    elseif (isset($_SESSION['user']['email'])) {
        $user_id = $_SESSION['user']['id'];
        // update billing and shipping user data.
    }
    else $user_id = null;

    // Calculate shipping tax based on items in cart
    $shipping_tax = \Core\ShoppingCart::getCartPrice() >= $GLOBALS['conf']['shipping_threshold'] ? 0 : $GLOBALS['conf']['shipping_tax'];

    $db->query("INSERT INTO orders (user_id, status, payed, shipping_tax, payment_type, remote_ip)
                VALUES (:user_id, :status, :payed, :shipping_tax, :payment_type, INET_ATON(:ipAddress))",
                [
                    'user_id' => $user_id,
                    'status' => 'Pending',
                    'payed' => 'No',
                    'shipping_tax' => $shipping_tax,
                    'payment_type' => $payment,
                    'ipAddress' => $_SERVER['REMOTE_ADDR']
                ]
            );

    $order_id = $db->getLastID();

    if(!empty($_SESSION['cart'])) {
        $Products_total = 0;
        $email_products = '';
        foreach($_SESSION['cart'] as $key => $product) {
            $productdb = $db->query("SELECT price, discount, products.slug, categories.slug AS category_slug FROM products LEFT JOIN categories ON categories.category_id = products.category WHERE id = :product_id", [':product_id' => $product['id']])->find();
            $db->query("INSERT INTO ordered_products (order_id, product_id, name, price, discount, size)
                        VALUES (:order_id, :product_id, :name, :price, :discount, :size)",
                        [
                            'order_id' => $order_id,
                            'product_id' => $product['id'],
                            'name' => $product['name'],
                            'price' => $productdb['price'],
                            'discount' => $productdb['discount'],
                            'size' => $product['features']['size']
                        ]);
            // Build email product list
            $email_products .= '<tr>';
            $email_products .= '<td style="width: 70%;">';
            $email_products .= '<a href="{{host}}/shop/'.$productdb['category_slug'].'/'.$productdb['slug'].'" target="_blank" style="text-decoration:none; color:#858585"><img src="https://tudorhalatiu.com/public/images/products/'.$product['id'].'/poster.avif" width="40" style="border-radius: 4px; float: left; margin-right: 10px;">';
            $email_products .= '<p>'.$product['name'].'<br>Mărime '.$product['features']['size'].'</p>';
            $email_products .= '</td>';
            $email_products .= '<td style="padding-bottom: 6px; padding-top: 6px; font-size: 13px; font-weight:600; text-align: right;">'.number_format(getPrice($productdb['price'], $productdb['discount']), 2, ',', '.') .' lei</td>';
            $email_products .= '</tr>';

            // Get total product price.
            $Products_total += getPrice($productdb['price'], $productdb['discount']);

        }
        // Set free shipping tax for orders over 400 lei.
        if($Products_total >= $GLOBALS['conf']['shipping_threshold']) $GLOBALS['conf']['shipping_tax'] = 0;
    }
    
    $db->query("INSERT INTO orders_billing (order_id, firstname, lastname, email, phone, country, county, city, address, zip)
                VALUES (:order_id, :firstname, :lastname, :email, :phone, :country, :county, :city, :address, :zip)", 
                [
                    'order_id' => $order_id,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'phone' => $phone,
                    'country' => $country,
                    'county' => $county,
                    'city' => $city,
                    'address' => $address,
                    'zip' => $zip,
                ]);

    $db->query("INSERT INTO orders_shipping (order_id, firstname, lastname,  phone, country, county, city, address, zip)
                VALUES (:order_id, :firstname, :lastname, :phone, :country, :county, :city, :address, :zip)", 
                [
                    'order_id' => $order_id,
                    'firstname' => $delivery_firstname,
                    'lastname' => $delivery_lastname,
                    'phone' => $delivery_phone,
                    'country' => $delivery_country,
                    'county' => $delivery_county,
                    'city' => $delivery_city,
                    'address' => $delivery_address,
                    'zip' => $delivery_zip,
                ]);

    // Update billing information if this is the first order. Fill in the missing fields.
    $db->query("UPDATE users_address 
                SET 
                    phone = COALESCE(NULLIF(:phone, ''), phone),
                    county = COALESCE(NULLIF(:county, ''), county),
                    country = COALESCE(NULLIF(:country, ''), country),
                    address = COALESCE(NULLIF(:address, ''), address),
                    zip = COALESCE(NULLIF(:zip, ''), zip),
                    city = COALESCE(NULLIF(:city, ''), city)
                WHERE 
                    user_id = '".$_SESSION['user']['id']."'
                    AND type = 'billing'", 
                [
                    'phone' => $phone,
                    'country' => $country,
                    'county' => $county,
                    'address' => $address,
                    'zip' => $zip,
                    'city' => $city
                ]);

    // Update shipping information if this is the first order. Fill in the missing fields.
    $db->query("UPDATE users_address 
                SET 
                    firstname = COALESCE(NULLIF(:firstname, ''), firstname),
                    lastname = COALESCE(NULLIF(:lastname, ''), lastname),
                    county = COALESCE(NULLIF(:county, ''), county),
                    country = COALESCE(NULLIF(:country, ''), country),
                    address = COALESCE(NULLIF(:address, ''), address),
                    zip = COALESCE(NULLIF(:zip, ''), zip),
                    phone = COALESCE(NULLIF(:phone, ''), phone),
                    city = COALESCE(NULLIF(:city, ''), city)
                WHERE 
                    user_id = '".$_SESSION['user']['id']."' 
                    AND type = 'shipping'",
                [
                    'firstname' => $delivery_firstname,
                    'lastname' => $delivery_lastname,
                    'county' => $delivery_county,
                    'country' => $delivery_country,
                    'address' => $delivery_address,
                    'zip' => $delivery_zip,
                    'phone' => $delivery_phone,
                    'city' => $delivery_city
                ]);

    $emailSender = new Core\EmailSender();
    $emailSender->sendEmail(
        $email,
        'Comanda numărul TH'. str_pad($order_id, 6, '0', STR_PAD_LEFT),
        'views/emails/Order.html',
        [
            'firstname' => $firstname,  
            'lastname' => $lastname,  
            'address' => $address,  
            'city' => $city,  
            'county' => $county,  
            'zip' => $zip,  
            'phone' => $phone,  
            'delivery_firstname' => $delivery_firstname,  
            'delivery_lastname' => $delivery_lastname,  
            'delivery_address' => $delivery_address,  
            'delivery_city' => $delivery_city,  
            'delivery_county' => $delivery_county,  
            'delivery_zip' => $delivery_zip,  
            'delivery_phone' => $delivery_phone,
            'delivery_email' => $delivery_email,
            'shipping_tax' => $GLOBALS['conf']['shipping_tax'] == 0 ? '<span style="color:#ed0078">gratuit</span>' : $GLOBALS['conf']['shipping_tax'] . ' lei',
            'date' => roDate(date('Y-m-d')),
            'products_total' => number_format($Products_total, 2, ',', '.'),
            'products' => $email_products,
            'total' => number_format(($Products_total + $GLOBALS['conf']['shipping_tax']), 2, ',', '.'),
            'payment_method' => $payment,
            'order_id' => str_pad($order_id, 6, '0', STR_PAD_LEFT),
            'currency' => 'lei',
            'host' => $_SERVER['HTTP_HOST']
        ]
    );
    \Core\ShoppingCart::emptyCart();
    return redirect('/comanda-trimisa');
}

Session::flash('errors', $form->errors());

Session::flash('old', [ 
    'firstname' => $_POST['firstname'],
    'lastname' => $_POST['lastname'],
    'cart_email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'city' => $_POST['city'],
    'county' => $_POST['county'],
    'zip' => $_POST['zip'],
    'address' => $_POST['address'],
    'delivery_firstname' => $_POST['delivery_firstname'],
    'delivery_lastname' => $_POST['delivery_lastname'],
    'delivery_phone' => $_POST['delivery_phone'],
    'delivery_city' => $_POST['delivery_city'],
    'delivery_county' => $_POST['delivery_county'],
    'delivery_zip' => $_POST['delivery_zip'],
    'delivery_address' => $_POST['delivery_address'],
    'account-create' => $_POST['account-create'],
    'delivery' => $_POST['delivery'],
]);

return redirect('/cart');