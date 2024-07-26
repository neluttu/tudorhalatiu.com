<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<form name="cancel-order" id="cancel-order" method="post">
        <input type="hidden" name="_method" value="PATCH" />
        <input type="hidden" name="id" value="<?= $order['id']?>">
        <input type="hidden" name="token" value="<?= $order['token']?>">
</form>
<main class="flex flex-col items-start justify-start w-full gap-6 px-2 mt-2 md:mt-10 md:flex-row max-w-7xl">
    <div class="w-full md:grow">
        <? 
        //TODO: check error message / success message
        if(isset($errors)) : ?>
        <div class="p-2 py-3 mb-5 border rounded-md empty:hidden font-lighter border-rose-400 bg-rose-50">
            <p class="text-sm text-main-color"><?= $errors['message']; ?></p>
        </div>
        <? endif ?>
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
            <li class="flex items-center justify-start gap-2 pb-3 border-b border-b-gray-200 <?= $order['payed'] === 'No' ? 'text-main-color' : 'text-green-600' ?>">
                <span class="flex items-center justify-start gap-1 grow">
                    <? if($order['payed'] === 'No') :?>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#af0054" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 9v4" />
                        <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                        <path d="M12 16h.01" />
                    </svg>
                    <? else : ?>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check-filled" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#00b341" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" stroke-width="0" fill="currentColor" />
                        </svg>
                    <? endif ?>
                    Sumă achitată:
                </span>
                <span><?= $order['payed'] === 'Yes' ? number_format($total, 2, ',', '.') : 0 ?> <?= $product['currency'] ?></span>
            </li>
            <li class="flex items-center justify-start gap-2 pb-3 border-b border-b-gray-200">
                <span class="grow">

                    Taxă transport inclusă:
                </span>
                <span><?= $order['shipping_tax'] ?> <?= $product['currency'] ?></span>
            </li>
            <li class="flex items-center justify-end gap-2 pb-3">
                <? if($order['payed'] === 'No' and $order['status'] == 'Pending') : ?><button type="button" class="px-2 py-1 text-sm font-normal text-white bg-red-600 rounded-md open-modal md:py-2">Anulează comanda</button><? endif ?>
            </li>
        </ul>
        <script src="/public/js/simpleModal.js"></script>
        <div class="fixed top-0 left-0 z-50 items-center justify-center hidden w-full h-screen bg-black/90 close-modal" id="modal">
            <div class="flex items-start justify-start max-w-md gap-4 p-5 mx-2 bg-white rounded-lg min-w-80 sm:mx-0 modal-content">
                <div class="flex flex-col items-start justify-start w-full gap-4 text-base font-normal">
                    <span class="flex items-center justify-start w-full gap-2 pb-2 text-red-700 border-b-2 border-slate-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 stroke-red-700" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 9v4" />
                            <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                            <path d="M12 16h.01" />
                        </svg>
                        Confirmă anularea
                    </span>
                    <span class="font-light">Ești sigur că dorești să anulezi această comandă? </span>
                    <div class="flex items-center justify-end w-full gap-2 font-light">
                        <button class="block w-auto px-4 py-3 text-sm font-normal text-red-700 bg-red-200 rounded-lg md:order-2 confirm-btn">Da</button>
                        <button class="block w-auto px-4 py-3 text-sm font-normal bg-gray-200 rounded-lg md:order-1 close-modal">Nu</button>
                    </div>
                </div>
            </div>
        </div>
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
                <h2 class="mb-4 font-bold">Informații plată:</h2>
                <p>Plată online prin <span class="text-[#466afc] font-semibold">TwisPay</span></p>
                <p>Stare plată: <?= $order['payed'] === 'Yes' ? '<span class="font-semibold text-green-600">confirmată</span>' : '<span class="text-main-color">neachitată.</span>' ?></p>
                <p><? if($order['payed'] === 'No' and $order['status'] != 'Canceled') : ?>
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