<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="w-full mt-10 max-w-7xl">
    <section class="px-2 lg:px-0">
        <? Core\Session::getMessage(); ?>
        <ul class="flex flex-col flex-wrap items-start justify-center gap-4">
            <? $Total = 0; ?>
            <? if(!empty($_SESSION['cart'])) foreach($_SESSION['cart'] as $key => $product) : ?>
                <li class="w-full p-3 transition-all duration-200 ease-in bg-white rounded-md hover:bg-slate-100 border-slate-300">
                    <form name="updateCart" method="post" class="flex items-center justify-start gap-4">
                        <input type="hidden" name="cartID" value="<?= $key ?>">
                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="name" value="<?= $product['name'] ?>">
                        <input type="hidden" name="quantity" value="0">
                        <a href="product/<?=slug($product['name'])?>/<?=$product['id']?>"><img src="/public/images/products/<?=$product['id']?>.jpg" class="w-[80px] aspect-square inline mr-5 rounded-md"></a>
                        <p class="flex flex-col items-start justify-start flex-1">
                            <? 
                            echo '<a href="product/'. slug($product['name']) . '/' . $product['id'] .'" class="block text-lg hover:underline">' . $product['name'] . '</a>';
                            echo '<span class="block mt-2 text-sm text-slate-600">Mărime ' . implode(', ', $product['features']). '</span>';
                            ?>
                        </p>
                        <p class="pr-4"><?= number_format($product['price'], 2, ',', '.'); ?> lei</p>
                    <!-- <span class="px-3">x</span> -->
                
                    <!-- <select class="p-2 bg-white border rounded-md" name="quantity">
                        <option value="0"><?= Core\Lang::text('product.cart_remove_option');?></option>
                        <? for($i = 1; $i <= 50; $i++) : ?>
                        <option value="<?= $i ?>" <? echo ($i == $_SESSION['cart'][$key]['quantity']) ? 'selected' : '' ?>><?= $i; ?></option>
                        
                        <? 
                        endfor; 
                        ?>
                    </select> -->

                    <button type="submit" class="p-1 text-white hover:bg-[#ed0078] rounded-md bg-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
                        <!-- <?= \Core\Lang::text('product.update_cart_item'); ?> -->
                    </button>
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
            Total: <?= number_format($Total, 2, ',', '.');?> lei
        </p>
        
        <div class="flex flex-col items-center justify-start gap-4 p-3 mt-10 border rounded-md sm:flex-row">
            <p class="grow">Pentru a putea finaliza cumpărăturile este necesar să vă autentificați în contul dvs.</p>
            <a href="/login" class="block w-full px-3 py-2 text-center text-white bg-orange-500 border border-orange-600 rounded-md sm:w-auto">Autentificare</a>
            <a href="/register" class="block w-full px-3 py-2 text-center text-white bg-orange-500 border border-orange-600 rounded-md sm:w-auto">Înregistrare</a>
        </div>
    </section>
</main>
<? require base_path('views/partials/footer.php'); ?>