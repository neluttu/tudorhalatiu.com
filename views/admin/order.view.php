<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<form name="cancel-order" id="cancel-order" method="post">
        <input type="hidden" name="_method" value="PATCH" />
        <input type="hidden" name="id" value="<?= $order['id']?>">
</form>
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
        <ul class="flex flex-col gap-3 text-sm">
            <li class="flex items-center justify-start gap-2 pb-3 border-b border-b-gray-200">
                <span class="grow">Stare comandă:</span>
                <select class="p-2 bg-transparent border rounded-md border-main-color">
                    <option value="Pending" <?= $order['status'] == 'Pending' ? 'selected' : '' ?>>În așteptare</option>
                    <option value="Processing" <?= $order['status'] == 'Processing' ? 'selected' : '' ?>>În lucru</option>
                    <option value="Completed" <?= $order['status'] == 'Completed' ? 'selected' : '' ?>>Finalizată</option>
                    <option value="Canceled" <?= $order['status'] == 'Canceled' ? 'selected' : '' ?>>Anulată</option>
                </select>
            </li>
            <li class="flex items-center justify-start gap-2 pb-3 border-b border-b-gray-200">
                <span class="grow">Sumă de plată:</span>
                <input name="price" type="text" class="w-20 p-1 bg-transparent border rounded-md border-main-color" value="<?= number_format($total, 2, '.' ,'') ?>"> <?= $product['currency'] ?>
            </li>
            
            <li class="flex items-center justify-start gap-2 pb-3 border-b border-b-gray-200">
                <span class="grow">Taxă transport inclusă:</span>
                <input name="shipping_tax" type="text" class="w-10 p-1 bg-transparent border rounded-md border-main-color" value="<?= $order['shipping_tax'] ?>"> <?= $product['currency'] ?>
            </li>
        </ul>
        <p class="mt-10 mb-4 text-xl font-semibold text-main-color">Informații livrare și facturare</p>
        <ul class="grid w-full grid-cols-1 gap-4 sm:grid-cols-3">
            <li class="p-3 border rounded-md [&>p]:text-sm [&>p]:py-1 font-light">
                <h2 class="mb-4 font-bold">Date livrare:</h2>
                <p>Livrare curier Cargus</p>
                <p>Număr AWB: <input name="awb" type="text" class="w-20 p-1 bg-transparent border rounded-md border-main-color" value="<?= $order['awb'] ?>"></p>
                <p>Către: <?= $shipping['firstname'] . ' ' . $shipping['lastname'] ?></p>
                <p>Telefon: <?= $shipping['phone'] ?></p>
            </li>
            <li class="p-3 border rounded-md [&>p]:text-sm [&>p]:py-1 font-light">
                <h2 class="mb-4 font-bold">Date facturare:</h2>
                <p><a href="" class="underline">Client: <?= $billing['firstname'] . ' ' . $billing['lastname'] ?>, <?= $billing['phone'] ?></a></p>
                <p>Adresa: <?= $billing['address'] . ', ' . $billing['city'] . ', ' . $billing['county'] . ', '. $billing['zip'] ?></p>
                <p>Telefon: <?= $billing['phone'] ?></p>
            </li>
            <li class="p-3 border rounded-md [&>p]:text-sm [&>p]:py-1 font-light">
                <h2 class="mb-4 font-bold">Modalitate plată:</h2>
                <p>Plată online prin Netopia</p>
                <p>Stare plată: 
                <select class="p-2 bg-transparent border rounded-md border-main-color">
                    <option value="Yes" <?= $order['payed'] === 'Yes' ? 'selected' : '' ?>>achitată</option>
                    <option value="No" <?= $order['payed'] === 'No' ? 'selected' : '' ?>>neachitată</option>
                </select>    
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