<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="w-full mt-10 max-w-7xl">
    <? Core\Session::getMessage(); ?>
    <section class="flex flex-col items-start justify-start w-full gap-4 px-2 lg:px-0 md:flex-row">
        <div class="w-full grow">
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
                                echo '<a href="product/'. slug($product['name']) . '/' . $product['id'] .'" class="block text-base hover:underline">' . $product['name'] . '</a>';
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
            <p class="inline-block mt-20 mb-4 font-normal text-base text-[#ed0078]">Info comandă</p>
            <div class="flex flex-col flex-wrap items-start justify-start w-full gap-4 md:flex-row">
                <div class="relative flex-1 w-full mt-2">
                    <input type="text" name="email" id="email" value="<?= old('email'); ?>" placeholder="Adresă email" class="w-full px-0 py-2 mt-1 border-b-2 border-gray-200 peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                    <label for="email" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Adresă email</label>
                </div>
                <div class="relative flex-1 w-full mt-2">
                    <input type="text" name="email" id="email" value="<?= old('email'); ?>" placeholder="Adresă email" class="w-full px-0 py-2 mt-1 border-b-2 border-gray-200 peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                    <label for="email" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Adresă email</label>
                </div>
                <div class="relative flex-1 w-full mt-2">
                    <input type="text" name="email" id="email" value="<?= old('email'); ?>" placeholder="Adresă email" class="w-full px-0 py-2 mt-1 border-b-2 border-gray-200 peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                    <label for="email" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Adresă email</label>
                </div>
            </div>
        </div>
        
        <form name="checkout" class="p-1 md:p-3 text-sm font-light md:border rounded-md text-slate-700 w-full md:w-[380px] shrink-0">
            <p class="inline-block mb-4 font-normal text-base text-[#ed0078]">Sumar comandă: 1 articol.</p>
            <p class="flex items-center justify-start py-3 border-b">
                <span class="grow">Subtotal</span>
                <span class="text-right">680,00 lei</span>
            </p>
            <p class="flex items-center justify-start py-3 border-b">
                <span class="grow">Transport</span>
                <span class="text-right">16 lei</span>
            </p>
            <p class="flex items-center justify-start py-3 border-b">
                <span class="grow">Total</span>
                <span><?= number_format($Total + 16, 2, ',', '.');?> lei</span>
            </p>

            <p class="inline-block mt-10 font-normal text-base text-[#ed0078]">Metodă de plată</p>

            <label for="mobilpay" class="flex items-center justify-start gap-2 mt-4 cursor-pointer">
                <input type="radio" name="payment" id="mobilpay" value="netopia" checked> <span>Online - Netopia Payments </span> <img src="/public/images/mobilpay.gif">
            </label>
            <label for="ramburs" class="flex items-center justify-start gap-2 mt-4 cursor-pointer">
                <input type="radio" name="payment" id="ramburs" value="ramburs"> <span>Plata ramburs </span>
            </label>
            <label for="terms" class="flex items-start justify-start gap-3 mt-10 cursor-pointer">
                <input type="checkbox" name="terms" id="terms" class="mt-1">
                <span>Am citit și sunt de acord cu <a href="#" class="text-[#ed0078] hover:underline">termenii și condițiile de utilizare</a> a magazinului online.</span>
            </label>

            <label for="privacy" class="flex items-start justify-start gap-3 mt-3 cursor-pointer">
                <input type="checkbox" name="privacy" id="privacy" class="mt-1">
                <span>Am citit și sunt de acord cu <a href="#" class="text-[#ed0078] hover:underline">politica de confidențialitate</a>.</span>
            </label>

            <button class="flex items-center justify-center bg-[#ed0078] w-full py-4 mt-6 text-white rounded-md font-semibold">
                Înregistrează comanda și achită
            </button>
        </form>
    </section>
</main>
<? require base_path('views/partials/footer.php'); ?>