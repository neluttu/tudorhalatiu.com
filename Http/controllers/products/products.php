<?
use Core\App;
use Core\SchemaGenerator;

$db = App::resolve('Core\Database');
//dd($params['category']);
$products = $db->query('SELECT products.*, categories.name AS category_name, categories.text AS category_description, categories.slug AS category_slug, categories.text FROM products LEFT JOIN categories ON categories.category_id = products.category WHERE categories.slug = :slug AND status = "Online"', 
                    [
                        'slug' => $params['category']
                    ])->findAllOrFail();

$categories = $db->query('SELECT category_id, name, slug FROM categories')->get();

$schema_items = '';
foreach($products as $product) {
        $schema_items .= '{';
        $schema_items .= '"@type": "Product",';
        $schema_items .= '"name": "'.$product['name'].'",';
        $schema_items .= '"url": "https://tudorhalatiu.com/shop/'.$product['category_slug'].'/'.$product['slug'].'",';
        $schema_items .= '"image": "https://tudorhalatiu.com/public/images/products/'.$product['id'].'/poster.avif",';
        $schema_items .= '"description": "'.$product['excerpt'].'",';
        $schema_items .= '"brand": { "@type": "Brand", "name": "Tudor Halațiu" },';
        $schema_items .= '"offers": { "@type": "Offer", "price": "'.$product['price'].'", "priceCurrency": "RON", "unitPrice": "'.$product['price'].'", "unitPriceCurrency": "RON", "priceValidUntil": "2099-12-01", "itemCondition": "https://schema.org/NewCondition", "availability": "https://schema.org/InStock", "hasMerchantReturnPolicy": { "@type": "MerchantReturnPolicy", "merchantReturnDays": "15", "merchantReturnLink": "https://tudorhalatiu.com/termeni-si-conditii", "returnPolicyCategory": "https://schema.org/MerchantReturnFiniteReturnWindow", "applicableCountry": "RO", "returnMethod": "https://schema.org/ReturnByMail", "returnFees": "https://schema.org/FreeReturn" }, "applicableLocation": { "@type": "Country", "name": "Romania" }, "shippingDetails": { "@type": "OfferShippingDetails", "shippingDestination": { "@type": "DefinedRegion", "addressCountry": "RO", "addressRegion": ["RO"] }, "shippingRate": { "@type": "MonetaryAmount", "currency": "RON", "value": "'.$product['price'].'" }, "deliveryTime": { "@type": "ShippingDeliveryTime", "handlingTime": { "@type": "QuantitativeValue", "minValue": 2,  "maxValue": 7, "unitCode": "DAY" }, "transitTime": { "@type": "QuantitativeValue", "minValue": 1,  "maxValue": 5, "unitCode": "DAY" } } } },';
        $schema_items .= '"review": { "@type": "Review", "author": { "@type": "Person", "name": "Ionela" }, "reviewBody": "Calitate excelentă și se potrivește perfect. Perfectă pentru o seară specială.", "datePublished": "2024-05-03", "rating": 5, "bestRating": 5 }';
        $schema_items .= '},';
}
$schema_items = substr($schema_items, 0, -1);

$schema = new SchemaGenerator('Category.json');
$schema = $schema->generateSchema(['category_name' => $products[0]['category_name'] . ' by Tudor Halațiu', 'excerpt' => $products[0]['text'], 'items' => $schema_items]);

view('products/products', [
    'heading' => $products[0]['category_name'],
    'heading_info' => $db->totalRows() . ' produse în total',
    'products' => $products,
    'title' => $products[0]['category_name'] . ' by Tudor Halațiu - creator de modă',
    'description' => limitText($products[0]['text']),
    'categories' => $categories,
    'current_category' => $params['category'],
    'schema' => $schema,
    'keywords' => 'tudor halatiu, creator moda, designer, vestimentar, haine, '
]);