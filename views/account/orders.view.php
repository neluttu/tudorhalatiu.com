<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main class="flex flex-col items-start justify-start w-full gap-6 px-2 mt-2 md:mt-10 md:flex-row max-w-7xl">
    <div class="flex shrink-0 flex-row md:flex-col flex-wrap items-start md:justify-center w-full md:w-64 gap-3 text-slate-600 [&>a]:border-b [&>a]:border-transparent  [&>a:hover]:text-[#ed0078] [&>a:hover]:border-b [&>a:hover]:border-[#ed0078]">
        <? require base_path('views/account/menu.view.php') ?>
    </div>
    <div class="w-full md:grow">
        <h1 class="mb-10 text-lg">Comenzi în magazin</h1>

        
        <? foreach($orders as $order) : ?>
            <div class="mb-10">
                <span class="block mb-4 text-main-color">Comanda numarul: <?=$order['order_id']?></span>
                <?
                $products = explode(';',$order['products']);
                $total_price = 0;
                foreach($products as $product) {
                    $product_data = explode(':',$product);
                    if (count($product_data) >= 6) { 
                        $product = [
                            'product_id' => $product_data[0],
                            'name' => $product_data[1],
                            'price' => $product_data[2],
                            'currency' => $product_data[3],
                            'quantity' => $product_data[4],
                            'size' => $product_data[5]
                        ];
                    }
                    $total_price += $product['price'];
                    ?>
                    <div class="flex items-center justify-start w-full gap-3 p-2 mb-2 text-sm text-gray-700 border rounded-lg">
                        <a href="/product/<?= strtolower(str_replace(' ','-',$product['name'])) ?>/<?= $product['product_id']?>">
                            <img src="/public/images/products/<?=$product['product_id']?>/poster.jpg" width="40" class="rounded-md">
                        </a>
                        <span>
                            <?= $product['name'] ?><br>
                            Mărime: <?= $product['size'] ?>
                        </span>
                        <span class="text-right grow">
                            <?= $product['price']. ' ' . $product['currency'] ?>
                        </span>
                    </div>
                <? } ?>
                <p class="float-right w-full text-right">Total: <?= number_format($total_price, 2, ',', '.') ?> lei</p>
            </div>
        <? endforeach ?>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>