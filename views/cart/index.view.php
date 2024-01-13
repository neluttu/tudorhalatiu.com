<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main>
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">

        <? if(isset($_SESSION['_flashed']['cart_message']['result'])) : ?>
            <div class="p-3 mb-4 text-white bg-blue-400 border border-blue-500 rounded-md">
                <?= $_SESSION['_flashed']['cart_message']['result'] ?? 'No error message available at this time...'; ?>
            </div>
        <? endif ?>
    

        <ul class="flex flex-col flex-wrap items-start justify-center gap-4">
            <?
            $Total = 0;
            ?>
            <? if(!empty($_SESSION['cart'])) foreach($_SESSION['cart'] as $key => $product) : ?>
                <li class="w-full p-3 bg-white border rounded-md border-slate-300">
                    <form name="updateCart" method="post" class="flex items-center justify-start gap-4">
                        <input type="hidden" name="cartID" value="<?= $key ?>">
                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="name" value="<?= $product['name'] ?>">
                        <input type="hidden" name="quantity" value="0">
                    <p class="flex items-center justify-start flex-1">
                        <a href="product/<?=slug($product['name'])?>/<?=$product['id']?>"><img src="/public/images/products/<?=$product['id']?>.jpg" class="w-[80px] aspect-square inline mr-3 rounded-md"></a>
                        <? 
                            echo '<a href="product/'. slug($product['name']) . '/' . $product['id'] .'" class="block hover:underline">' . $product['name'];
                            echo '<br>' . implode(', ', $product['features']). '</a>';
                        ?>
                    </p>
                    <p class="pr-4"><?=$product['price']; ?> lei</p>
                    <!-- <span class="px-3">x</span> -->
                
                    <!-- <select class="p-2 bg-white border rounded-md" name="quantity">
                        <option value="0"><?= Core\Lang::text('product.cart_remove_option');?></option>
                        <? for($i = 1; $i <= 50; $i++) : ?>
                        <option value="<?= $i ?>" <? echo ($i == $_SESSION['cart'][$key]['quantity']) ? 'selected' : '' ?>><?= $i; ?></option>
                        
                        <? 
                        endfor; 
                        ?>
                    </select> -->
                    <button type="submit" class="px-3 py-2 text-white bg-blue-500 border border-blue-600 rounded-md hover:bg-blue-400"><?= \Core\Lang::text('product.update_cart_item'); ?></button>
                </form>
            </li>
            <? 
            $Total += (int) $_SESSION['cart'][$key]['quantity'] * $product['price'];

            endforeach; 
            else 
                echo 'You do not have any items in your shopping cart.'; 
            ?>
        </ul>
        <p class="flex items-center justify-end mt-3 text-lg font-semibold">
            Total, <?=  number_format($Total, 2);?> lei.
        </p>
        <div class="flex items-center justify-end">
            <button class="px-3 py-2 mt-3 text-white bg-orange-500 border border-orange-600 rounded-md"><?= \Core\Lang::text('product.checkout_button') ?></button>
        </div>
    </div>
</main>
<? require base_path('views/partials/footer.php'); ?>