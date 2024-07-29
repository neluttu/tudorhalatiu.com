<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main class="flex flex-col items-start justify-start w-full gap-6 px-2 mt-2 md:mt-10 md:flex-row max-w-7xl">
    <div class="flex shrink-0 flex-row md:flex-col flex-wrap items-start md:justify-center w-full md:w-64 gap-3 text-slate-600  [&>a]:border-b [&>a]:border-transparent  [&>a:hover]:text-main-color [&>a:hover]:border-b [&>a:hover]:border-main-color">
        <? require base_path('views/admin/menu.view.php') ?>
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
        <form method="POST">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
            <input type="hidden" name="user_id" value="<?= $order['user_id'] ?>">
            <input type="hidden" name="token" value="<?= $order['token'] ?>">
            <ul class="flex flex-col gap-3 text-sm">
                <li class="flex items-center justify-start gap-2 pb-3 border-b border-b-gray-200">
                    <span class="grow">Stare comandă:</span>
                    <select name="status" id="status" class="p-2 bg-transparent border rounded-md border-main-color">
                        <option value="Pending" <?= $order['status'] == 'Pending' ? 'selected' : '' ?>>În așteptare</option>
                        <option value="Processing" <?= $order['status'] == 'Processing' ? 'selected' : '' ?>>În lucru</option>
                        <option value="Completed" <?= $order['status'] == 'Completed' ? 'selected' : '' ?>>Finalizată</option>
                        <option value="Canceled" <?= $order['status'] == 'Canceled' ? 'selected' : '' ?>>Anulată</option>
                    </select>
                </li>
                <li class="flex items-center justify-start gap-2 pb-3 border-b border-b-gray-200">
                    <span class="grow">Sumă de plată:</span>
                    <?= number_format($total, 2, '.' ,'') ?> <?= $product['currency'] ?>
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
                    <span class="grow">Taxă transport inclusă:</span>
                    <?= $order['shipping_tax'] ?> <?= $product['currency'] ?>
                </li>
                <li class="flex items-center justify-start gap-2 pb-3 border-b border-b-gray-200">
                    <span class="grow">Număr AWB transport:</span>
                    <input name="awb" type="text" class="w-32 p-1 bg-transparent border rounded-md border-main-color" value="<?= $order['awb'] ?>">
                </li>
            </ul>
            <div class="flex items-center justify-end">
                <button type="submit" class="px-2 py-1 mt-4 text-sm font-normal text-white rounded-md bg-cyan-600 md:py-2">Actualizează comanda</button>
            </div>
        </form>
        <p class="mt-10 mb-4 text-xl font-semibold text-main-color">Informații livrare, facturare și plată</p>
        <ul class="grid w-full grid-cols-1 gap-4 sm:grid-cols-3">
            <li class="p-3 border rounded-md [&>p]:text-sm [&>p]:py-1 font-light">
                <h2 class="mb-4 font-bold">Date livrare:</h2>
                <p>Livrare curier <span class="text-[#dc0032] font-semibold">DPD</span></p>
                <p>Către: <?= $shipping['firstname'] . ' ' . $shipping['lastname'] ?></p>
                <p>Adresa: <?= $shipping['address'] . ', ' . $shipping['city'] . ', ' . $shipping['county'] . ', ' . $shipping['zip'] ?></p>
                <p>Telefon: <?= $shipping['phone'] ?></p>
            </li>
            <li class="p-3 border rounded-md [&>p]:text-sm [&>p]:py-1 font-light">
                <h2 class="mb-4 font-bold">Date facturare:</h2>
                <p><a href="" class="underline">Client: <?= $billing['firstname'] . ' ' . $billing['lastname'] ?>, <?= $billing['phone'] ?></a></p>
                <p>Adresa: <?= $billing['address'] . ', ' . $billing['city'] . ', ' . $billing['county'] . ', '. $billing['zip'] ?></p>
                <p>Telefon: <?= $billing['phone'] ?></p>
            </li>
            <li class="p-3 border rounded-md [&>p]:text-sm [&>p]:py-1 font-light">
                    <h2 class="mb-4 font-bold">Informații plată:</h2>
                    <p>Stare plată: <?= $order['payed'] === 'Yes' ? '<span class="font-semibold text-green-600">confirmată</span>' : '<span class="text-main-color">neachitată.</span>' ?></p>
                    <p>Plată online prin <span class="text-[#466afc] font-semibold">TwisPay</span></p>
                    <p>
                        <? if($order['invoice'] === null) : ?>
                            <form method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="token" value="<?= $order['token'] ?>">
                                <span class="flex items-center justify-start gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-rose-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.3" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                                        <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                                        <path d="M17 18h2" />
                                        <path d="M20 15h-3v6" />
                                        <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
                                    </svg>
                                    <a href="/invoice/<?= $order['token'] ?>" class="font-semibold text-green-600 underline">Descară factura fiscală</a><br>

                                </span>
                                <button type="submit" class="px-2 py-1 mt-2 text-sm font-normal text-white rounded-md bg-rose-600 md:py-2 ">Șterge factura</button>
                            </form>
                        <? else : ?> 
                            <form method="post" enctype="multipart/form-data">
                                <input type="hidden" name="token" value="<?= $order['token'] ?>">
                                <input type="file" name="invoice" accept=".pdf" required>
                                <button type="submit" class="px-2 py-1 mt-2 text-sm font-normal text-white rounded-md bg-cyan-600 md:py-2 ">Încarcă factură</button>
                            </form>
                        <? endif ?>
                    </p>
                </form>
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
                    <p>
                        Mărime: 
                        <select class="w-12 p-1 bg-transparent border rounded-md border-main-color" name="size">
                            <? foreach($sizes as $size) : ?>
                            <option value="<?= $size ?>" <?= $product['size'] == $size ? 'selected' : '' ?>><?= $size ?></option>
                            <? endforeach ?>
                        </select>
                    </p>
                </div>
                <span class="text-right grow">
                    <input type="text" name="price" value="<?= number_format($product['price'], 2, '.', '') ?>" class="w-16 p-1 bg-white border rounded-lg border-main-color"> lei 
                    <select name="discount" class="w-16 p-1 text-sm text-right bg-white border rounded-md border-main-color">
                        <option value="0" <?= $product['discount'] == '0' ? 'selected' : '' ?>>-0%</option>
                        <option value="25" <?= $product['discount'] == '25' ? 'selected' : '' ?>>-25%</option>
                        <option value="50" <?= $product['discount'] == '50' ? 'selected' : '' ?>>-50%</option>
                        <option value="75" <?= $product['discount'] == '75' ? 'selected' : '' ?>>-75%</option>
                    </select>
                    <div class="mt-2">
                        <?= $product['discount'] > 0 ? '<span class="line-through">' . number_format($product['price'], 2, ',', '.') . '</span> ' . number_format(getPrice($product['price'], $product['discount']), 2, ',', '.'). ' ' . $product['currency'] : number_format($product['price'], 2, ',', '.') . ' ' . $product['currency'] ?>
                    </div>
                </span>
            </li>
            <? endforeach ?>
        </ul>
    </div>
</main>
<? require base_path('views/partials/footer.php'); ?>