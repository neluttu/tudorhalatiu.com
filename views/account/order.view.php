<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="flex flex-col items-start justify-start w-full gap-6 px-2 mt-2 md:mt-10 md:flex-row max-w-7xl">
    <div class="flex shrink-0 flex-row md:flex-col flex-wrap items-start md:justify-center w-full md:w-64 gap-3 text-slate-600  [&>a]:border-b [&>a]:border-transparent  [&>a:hover]:text-main-color [&>a:hover]:border-b [&>a:hover]:border-main-color">
        <? require base_path('views/account/menu.view.php') ?>
    </div>
    <div class="w-full md:grow">
        <div class="p-2 py-3 mb-5 border rounded-md empty:hidden font-lighter border-rose-400 bg-rose-50"><? if(isset($errors)) : foreach ($errors as $error) : ?>
            <p class="text-sm text-main-color"><?= $error; ?></p>
        <? endforeach; endif ?></div>
        <p class="mb-4 text-xl font-semibold text-main-color">Sumar comandă</p>
        <?
        $total = $order['shipping_tax'];
        foreach($products as $product) 
            $total += getPrice($product['price'],$product['discount']);
        ?>
        <ul class="flex flex-col gap-3 text-sm">
            <li class="flex items-center justify-start gap-2 pb-3 border-b border-b-gray-200">
                <span class="grow">Stare comandă:</span>
                <span><?= $order['status'] ?></span>
            </li>
            <li class="flex items-center justify-start gap-2 pb-3 border-b border-b-gray-200">
                <span class="grow">Sumă de plată:</span>
                <span><?= $total . '  ' . $product['currency'] ?></span>
            </li>
            <li class="flex items-center justify-start gap-2 pb-3 border-b border-b-gray-200">
                <span class="grow">Sumă achitată:</span>
                <span><?= $order['payed'] === 'Yes' ?  $total : 0 ?> <?= $product['currency'] ?></span>
            </li>
            <li class="flex items-center justify-end gap-2 pb-3">
                <? if($order['payed'] === 'No') : ?><button type="submit" class="px-2 py-1 text-sm font-normal text-white bg-red-600 rounded-md md:py-2">Anulează comanda</button><? endif ?>
                <? if($order['payed'] === 'No') : ?><button type="submit" class="px-2 py-1 text-sm font-normal text-white bg-green-600 rounded-md md:py-2 ">Achită acum</button><? endif ?>
            </li>
        </ul>
        <p class="mt-10 mb-4 text-xl font-semibold text-main-color">Informații livrare și facturare</p>
        <ul class="grid w-full grid-cols-1 gap-4 sm:grid-cols-3">
            <li class="p-3 border rounded-md [&>p]:text-sm [&>p]:py-1 font-light">
                <h2 class="mb-4 font-bold">Date livrare:</h2>
                <p>Livrare curier Cargus</p>
                <p>Număr AWB: <?= $order['awb'] ? $order['awb'] : 'indisponibil' ?></p>
                <p>Către: <?= $shipping['firstname'] . ' ' . $shipping['lastname'] ?></p>
                <p>Telefon: <?= $shipping['phone'] ?></p>
            </li>
            <li class="p-3 border rounded-md [&>p]:text-sm [&>p]:py-1 font-light">
                <h2 class="mb-4 font-bold">Date facturare:</h2>
                <p>Client: <?= $billing['firstname'] . ' ' . $billing['lastname'] ?>, <?= $billing['phone'] ?></p>
                <p>Adresa: <?= $billing['address'] . ', ' . $billing['city'] . ', ' . $billing['county'] . ', '. $billing['zip'] ?></p>
                <p>Telefon: <?= $billing['phone'] ?></p>
            </li>
            <li class="p-3 border rounded-md [&>p]:text-sm [&>p]:py-1 font-light">
                <h2 class="mb-4 font-bold">Modalitate plată:</h2>
                <p>Plată online prin Netopia</p>
                <p>Stare plată: <?= $order['payed'] === 'Yes' ? 'confirmată' : '<span class="text-main-color">neachitată.</span>' ?></p>
            </li>
        </ul>
        <p class="mt-10 mb-4 text-xl font-semibold text-main-color">Produsele din această comandă</p>
        <ul class="w-full">
            <? 
            // $total_price = $order['shipping_tax'];
            foreach($products as $product) : 

            // $total_price += getPrice($product['price'], $product['discount']);
            // $total_products++;
        
            ?>
            <li class="flex items-center justify-start w-full gap-3 p-2 mb-2 text-sm text-gray-700 transition-all duration-150 ease-in hover:bg-gray-50">
                <a href="/shop/<?= $product['category_slug'] ?>/<?= $product['slug'] ?>">
                    <img src="/public/images/products/<?= $product['product_id']?>/poster.avif" width="30" class="rounded-md" loading="lazy" alt="<?= $product['name']?>">
                </a>
                <div class="text-sm">
                    <p><?= $product['name']?></p>
                    <p>Mărime: <?= $product['size'] ?></p>
                </div>
                <span class="text-right grow">
                    <?= $product['discount'] > 0 ? '<span class="line-through">' . $product['price'] . '</span> ' . getPrice($product['price'], $product['discount']). ' ' . $product['currency'] : $product['price'] . ' ' . $product['currency'] ?>
                    <small class="block"><?= $product['discount'] > 0 ? '(-'.$product['discount'].'%)' : '' ?></small>
                </span>
            </li>
            <? endforeach ?>
        </ul>
    </div>
</main>
<? require base_path('views/partials/footer.php'); ?>