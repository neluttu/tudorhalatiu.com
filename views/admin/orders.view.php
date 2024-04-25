<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="flex items-start justify-start w-full gap-6 px-2 mt-10 max-w-7xl">
    <div class="flex flex-col items-start justify-center w-1/5 gap-3 shrink-0 text-slate-600 border-b [&>a]:border-b [&>a]:border-transparent  [&>a:hover]:text-[#ed0078] [&>a:hover]:border-b [&>a:hover]:border-[#ed0078]">
        <? require base_path('views/admin/menu.view.php') ?>        
    </div>
    <div class="flex-1 font-sans">
        <p>Până în prezent s-au făcut <?= count($orders) ?> comenzi în magazinul virtual.</p>
            <div class="grid grid-cols-1 gap-4">
            <? foreach($orders as $order) : ?>
                <div class="flex flex-col p-2 border rounded-md">
                    <div class="flex items-center justify-start gap-3">
                        <!-- <span class="block p-1 px-2 mb-2 text-sm text-white rounded-md bg-main-color">
                            Comanda numarul <?=$order['order_id']?> <br> <?= date('d.m.Y H:i', strtotime($order['ordered_at'])) ?>
                        </span> -->
                        <span class="flex-1 block py-0 mb-0">
                            <a href="tel:<?= $order['phone']?>"><span class="p-1 text-sm font-bold text-white rounded-md bg-main-color"><?=$order['order_id']?></span> <?= $order['firstname'] . ' ' . $order['lastname'] . '</a>' ?>
                        </span>
                        <div class="flex items-center justify-center gap-3 m-2">
                            <a href="tel:<?= $order['phone']?>">
                                <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.3" stroke="#009988" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                                    <path d="M15 9l5 -5" />
                                    <path d="M16 4l4 0l0 4" />
                                </svg>
                            </a>
                        <!-- <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-orange-600" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.3" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M7 9m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                                <path d="M14 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2" />
                            </svg>
                        </a> -->
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-main-color" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.3" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M13 9h6a2 2 0 0 1 2 2v6m-2 2h-10a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2" />
                                <path d="M12.582 12.59a2 2 0 0 0 2.83 2.826" />
                                <path d="M17 9v-2a2 2 0 0 0 -2 -2h-6m-4 0a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2" />
                                <path d="M3 3l18 18" />
                            </svg>
                        </a>
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.3" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 21h-7a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7" />
                                <path d="M3 10h18" />
                                <path d="M10 3v18" />
                                <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M19.001 15.5v1.5" />
                                <path d="M19.001 21v1.5" />
                                <path d="M22.032 17.25l-1.299 .75" />
                                <path d="M17.27 20l-1.3 .75" />
                                <path d="M15.97 17.25l1.3 .75" />
                                <path d="M20.733 20l1.3 .75" />
                            </svg>
                        </a>
                    </div>
                </div>
                    
                <div class="flex flex-col items-start justify-start flex-1">
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
                        
                        <div class="items-start justify-start hidden w-full gap-3 p-1 px-2 mb-2 text-xs text-gray-700">
                            <span class="">
                                <?= $product['name'] ?> (<?= $product['size'] ?>)
                            </span>
                            <span class="text-right grow">
                                <?= $product['price']. ' ' . $product['currency'] ?>
                            </span>
                        </div>
                            
                        <? } ?>
                    </div>
                    <p class="float-right w-full pt-2 text-sm font-semibold text-right">Total: <?= number_format($total_price, 2, ',', '.') ?> lei</p>
                </div>
            <? endforeach ?>        
        </div>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>
