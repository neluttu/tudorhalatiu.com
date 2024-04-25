<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="flex items-start justify-start w-full gap-6 px-2 mt-10 max-w-7xl">
    <div class="flex flex-col items-start justify-center w-1/5 gap-3 shrink-0 text-slate-600 border-b [&>a]:border-b [&>a]:border-transparent  [&>a:hover]:text-[#ed0078] [&>a:hover]:border-b [&>a:hover]:border-[#ed0078]">
        <? require base_path('views/admin/menu.view.php') ?>        
    </div>
    <div class="flex-1 text-sm">
        <p class="mb-10 text-lg">Până în prezent s-au făcut <?= count($orders) ?> comenzi în magazinul virtual.</p>
            <div class="grid grid-cols-1 gap-y-4">
            <? 
            foreach($orders as $order) : 
                $products = explode(';',$order['products']);
                $total_price = $order['shipping_tax']; // shipping price
                $total_products = 0;
                $productList = '';
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
                    $total_products++;
                    $productList .= '<span class="text-xs">'.$product['name'].' (' . $product['size'] .') </span>';
                    }
                ?>

                <div class="flex flex-col px-2 transition-all duration-150 ease-in border rounded-md hover:bg-white bg-gray-50">
                    <div class="flex items-center justify-start gap-3">
                        <span class="flex flex-col flex-1 py-2 mb-0 gap-y-2">
                            <a href="/admin/order/<?= $order['order_id']?>"><span class="p-1 px-2 text-sm font-bold text-white rounded-md bg-<?=$status[$order['status']]?>-600"> <?= str_pad($order['order_id'], 3, '0', STR_PAD_LEFT) ?></span> <?= $order['firstname'] . ' ' . $order['lastname'] ?>, <?= $total_products ?> produs(e), <span class="text-main-color"><?= number_format($total_price, 2, ',', '.') ?> lei</span>, în data: <?= date('d F Y, H:i', strtotime($order['ordered_at'])) ?></a>
                            <div class="flex items-center justify-start flex-1 gap-2 text-gray-400"><?= $productList ?></div>
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
                            <? if ($order['payed'] === 'Yes') : ?>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-green-600" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.3" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M7 9m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                                    <path d="M14 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2" />
                                </svg>
                            </a>
                            <? elseif($order['payed'] === 'No') : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-main-color" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.3" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M13 9h6a2 2 0 0 1 2 2v6m-2 2h-10a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2" />
                                <path d="M12.582 12.59a2 2 0 0 0 2.83 2.826" />
                                <path d="M17 9v-2a2 2 0 0 0 -2 -2h-6m-4 0a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2" />
                                <path d="M3 3l18 18" />
                            </svg>
                            <? elseif($order['payed'] === 'Refunded') : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card-refund" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 19h-6a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5" />
                                    <path d="M3 10h18" />
                                    <path d="M7 15h.01" />
                                    <path d="M11 15h2" />
                                    <path d="M16 19h6" />
                                    <path d="M19 16l-3 3l3 3" />
                                </svg>
                            <? endif ?>
                            <a href="/admin/order/<?= $order['order_id']?>">
                                <svg xmlns="http://www.w3.org/2000/svg" class="" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.3" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                </div>
            <? endforeach ?>        
        </div>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>
