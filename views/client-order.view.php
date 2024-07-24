<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main class="flex flex-col items-start justify-start w-full gap-6 px-2 mt-2 md:mt-10 md:flex-row max-w-7xl">
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
                <span><?= $status[$order['status']] ?></span>
            </li>
            <li class="flex items-center justify-start gap-2 pb-3 border-b border-b-gray-200">
                <span class="grow">Sumă de plată:</span>
                <span><?= number_format($total, 2, ',' ,'.') . '  ' . $product['currency'] ?></span>
            </li>
            <li class="flex items-center justify-start gap-2 pb-3 border-b border-b-gray-200">
                <span class="grow">Sumă achitată:</span>
                <span><?= $order['payed'] === 'Yes' ?  number_format($total, 2, ',', '.') : 0 ?> <?= $product['currency'] ?></span>
            </li>
            <li class="flex items-center justify-start gap-2 pb-3 border-b border-b-gray-200">
                <span class="grow">Taxă transport:</span>
                <span><?= $order['shipping_tax'] ?> <?= $product['currency'] ?></span>
            </li>
            <li class="flex items-center justify-end gap-2 pb-3">
                <? if($order['payed'] === 'No' and $order['status'] == 'Pending') : ?><button form="cancel-order" type="submit" class="px-2 py-1 text-sm font-normal text-white bg-red-600 rounded-md md:py-2">Anulează comanda</button><? endif ?>
            </li>
        </ul>
        <p class="mt-10 mb-4 text-xl font-semibold text-main-color">Informații livrare și facturare</p>
        <ul class="grid w-full grid-cols-1 gap-4 sm:grid-cols-3">
            <li class="p-3 border rounded-md [&>p]:text-sm [&>p]:py-1 font-light">
                <h2 class="mb-4 font-bold">Date livrare:</h2>
                <p>Livrare curier <span class="text-[#dc0032] font-semibold">DPD</span></p>
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
                <p>Plată online prin <span class="text-[#466afc] font-semibold">TwisPay</span></p>
                <p>Stare plată: <?= $order['payed'] === 'Yes' ? '<span class="font-semibold text-green-600">confirmată</span>' : '<span class="text-main-color">neachitată.</span>' ?></p>
                <p><? if($order['payed'] === 'No' and $order['status'] != 'Anulată') : ?>
                    <form id="twispay" action="https://<?= $twispayLive ? "secure.twispay.com" : "secure-stage.twispay.com" ?>" method="post" accept-charset="UTF-8" class="">
                        <input type="hidden" name="jsonRequest" value="<?= $base64JsonRequest ?>">
                        <input type="hidden" name="checksum" value="<?= $base64Checksum ?>">
                        <button type="submit" class="px-2 py-1 text-sm font-normal text-white bg-green-600 rounded-md md:py-2 ">Achită acum <?= number_format($total, 2, ',' ,'.'); ?> lei</button>
                    </form>
                    <? endif ?>
                </p>
                <p><? if($order['invoice'] !== null) : ?><button type="submit" class="px-2 py-1 text-sm font-normal text-white rounded-md bg-cyan-600 md:py-2 ">Vezi factura</button><? endif ?></p>
            </li>
        </ul>
        <p class="mt-10 mb-4 text-xl font-semibold text-main-color"><?= count($products) ?> produs(e) în această comandă</p>
        <ul class="w-full">
            <? foreach($products as $product) : ?>
            <li class="flex items-center justify-start w-full gap-3 p-2 mb-2 text-sm text-gray-700 transition-all duration-150 ease-in hover:bg-gray-50">
                <a href="/shop/<?= $product['category_slug'] ?>/<?= $product['slug'] ?>">
                    <img src="/public/images/products/<?= $product['product_id']?>/poster.avif" width="30" class="rounded-md" loading="lazy" alt="<?= $product['name']?>">
                </a>
                <div class="text-sm">
                    <p><?= $product['name']?></p>
                    <p>Mărime: <?= $product['size'] ?></p>
                </div>
                <span class="text-right grow">
                    <?= $product['discount'] > 0 ? '<span class="line-through">' . number_format($product['price'], 2, ',', '.') . '</span> ' . number_format(getPrice($product['price'], $product['discount']), 2, ',', '.'). ' ' . $product['currency'] : number_format($product['price'], 2, ',', '.') . ' ' . $product['currency'] ?>
                    <small class="block"><?= $product['discount'] > 0 ? '(-'.$product['discount'].'%)' : '' ?></small>
                </span>
            </li>
            <? endforeach ?>
        </ul>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>