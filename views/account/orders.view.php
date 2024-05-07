<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="flex flex-col items-start justify-start w-full gap-6 px-2 mt-2 md:mt-10 md:flex-row max-w-7xl">
    <div class="flex shrink-0 flex-row md:flex-col flex-wrap items-start md:justify-center w-full md:w-64 gap-3 text-slate-600  [&>a]:border-b [&>a]:border-transparent  [&>a:hover]:text-main-color [&>a:hover]:border-b [&>a:hover]:border-main-color">
        <? require base_path('views/account/menu.view.php') ?>
    </div>
    <div class="w-full md:grow">
        <p class="mb-2 text-xl font-semibold text-main-color">Salut <?= $_SESSION['user']['name']?>!</p>
        <? if (count($orders) > 0) : ?>
        <p>Până în prezent ai făcut <?= count($orders) ?> comenzi în magazinul virtual. <span class="text-main-color">Îți mulțumim!</span></p>
        <? else : ?>
        <p>Nu ai nici o comandă făcută în magazinul virtual. Vizitează <a href="/shop">pagina cu produse</a> pentru a vedea oferta.</p>
        <? endif ?>
        <? foreach($orders as $order) : ?>
            <div class="pb-4 my-10 border-b-2 border-gray-200">
                <a href="/account/order/<?= $order['order_id']?>" class="inline-flex items-center justify-start gap-2 pb-1 mb-1 text-base font-bold transition-all duration-150 ease-in border-b text-main-color border-b-transparent hover:border-b-main-color">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-main-color" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                        <path d="M11 13l9 -9" />
                        <path d="M15 4h5v5" />
                    </svg>
                    Comanda numarul #<?= str_pad($order['order_id'], 3, '0', STR_PAD_LEFT) ?>
                </a>
                <ul class="flex items-start justify-start gap-8 pb-2 mb-4 text-sm font-light text-gray-600 ">
                    <li>Din <?= roDate($order['ordered_at']) ?></li>
                    <li>În procesare</li>
                    <li>Achitată</li>
                </ul>
                <?
                $products = explode(';',$order['products']);
                // Start with the shipping tax as a total.
                $total_price = $order['shipping_tax'];
                foreach($products as $product) {
                    $product_data = explode(':',$product);
                    if (count($product_data) >= 6) { 
                        $product = [
                            'product_id' => $product_data[0],
                            'name' => $product_data[1],
                            'price' => $product_data[2],
                            'discount' => $product_data[3],
                            'currency' => $product_data[4],
                            'quantity' => $product_data[5],
                            'size' => $product_data[6]
                        ];
                    }
                    $total_price += getPrice($product['price'], $product['discount']);
                    ?>
                    <div class="flex items-center justify-start w-full gap-3 p-2 mb-2 text-sm text-gray-700 transition-all duration-150 ease-in hover:bg-gray-50">
                        <a href="/product/<?= strtolower(str_replace(' ','-',$product['name'])) ?>/<?= $product['product_id']?>">
                            <img src="/public/images/products/<?= $product['product_id'] ?>/poster.avif" width="30" class="rounded-md" loading="lazy" alt="<?= $product['name'] ?>">
                        </a>
                        <span>
                            <?= $product['name'] ?><br>
                            Mărime: <?= $product['size'] ?>
                        </span>
                        <span class="text-right grow">
                            <?= $product['discount'] > 0 ? '<span class="line-through">' . $product['price'] . '</span> ' . getPrice($product['price'], $product['discount']). ' ' . $product['currency'] : $product['price'] . ' ' . $product['currency'] ?>
                            <br>
                            <small><?= $product['discount'] > 0 ? '(-'.$product['discount'].'%)' : '' ?></small>
                        </span>
                    </div>
                <? } ?>
                <ul class="flex items-start justify-end w-full gap-4 text-sm font-bold text-main-color">
                    <li class="text-gray-700">Taxă Transport: <?= $order['shipping_tax'] ?> lei</li>
                    <li>Total: <?= number_format($total_price, 2, ',', '.') ?> lei</li>
                </ul>
            </div>
        <? endforeach ?>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>