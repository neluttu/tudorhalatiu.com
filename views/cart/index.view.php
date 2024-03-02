<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main class="w-full mt-10 max-w-7xl">
    <? Core\Session::getMessage(); ?>
    <section class="flex flex-col items-start justify-start w-full gap-4 px-2 md:gap-10 lg:px-0 md:flex-row">
        <div class="w-full grow">
            <ul class="flex flex-col flex-wrap items-start justify-center gap-4 pb-4 border-b-[3px] border-black">
                <? $Total = 0; ?>
                <? if(!empty($_SESSION['cart'])) foreach($_SESSION['cart'] as $key => $product) : ?>
                    <li class="w-full p-3 transition-all duration-200 ease-in bg-white rounded-md hover:bg-slate-100 border-slate-300">
                        <form name="updateCart" method="post" class="flex items-center justify-start gap-4">
                            <input type="hidden" name="_method" value="patch">
                            <input type="hidden" name="cartID" value="<?= $key ?>">
                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                            <input type="hidden" name="name" value="<?= $product['name'] ?>">
                            <input type="hidden" name="quantity" value="0">
                            <a href="product/<?=slug($product['name'])?>/<?=$product['id']?>" title="<?=$product['name']?>"><img src="/public/images/products/<?=$product['id']?>.jpg" alt="<?=$product['name']?>" class="w-[45px] inline  rounded-md"></a>
                            <p class="flex flex-col items-start justify-start flex-1">
                                <? 
                                echo '<a href="product/'. slug($product['name']) . '/' . $product['id'] .'" class="block text-base hover:underline">' . $product['name'] . '</a>';
                                echo '<span class="block mt-2 text-sm text-slate-600">Mărime ' . implode(', ', $product['features']). '</span>';
                                ?>
                            </p>
                            <p class="pr-4"><?= number_format($product['price'], 2, ',', '.'); ?> lei</p>
                            <button type="submit" class="p-1 text-white bg-black rounded-md hover:bg-main-color">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
                        </button>
                    </form>
                </li>
                <? 
                $Total += (int) $_SESSION['cart'][$key]['quantity'] * $product['price'];
                endforeach; 
                else echo 'You do not have any items in your shopping cart.';
                ?>
            </ul>
            <? if(!isset($_SESSION['user']['email'])) : ?>
            
            <p class="inline-flex items-center justify-center gap-2 mt-10 mb-4 text-base font-normal text-main-color">
                Dețin cont de client, mă autentific.
            </p>
            <form id="cart_login" action="<?= \Core\Session::getLang(); ?>/cart-login" method="post" class="grid grid-cols-1 pb-6 mb-2 border-b-[3px] border-black gap-x-6 gap-y-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="relative ">
                    <input type="text" required name="email" id="email" value="<?= old('email') ?? '' ?>" placeholder="Adresa de email" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['email']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                    <label for="email" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Adresa de email</label>
                </div>

                <div class="relative ">
                    <input type="password" required name="password" id="password" placeholder="Parola contului" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['email']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" />
                    <label for="password" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Parola contului</label>
                </div>

                <button type="submit" class="flex-1 w-full px-3 py-3 text-white rounded-md bg-main-color focus:bg-gray-600 focus:outline-none">Accesează contul de client</button>
                <div class="w-full"></div>

                <!-- <p class="text-xs text-gray-500">
                    <a href="<?= \Core\Session::getLang(); ?>/register" class="underline hover:no-underline focus:text-gray-800 focus:outline-none">Deschid cont nou</a> sau <a href="<?= \Core\Session::getLang(); ?>/reset-password" class="underline hover:no-underline focus:text-gray-800 focus:outline-none">resetez parola contului meu.</a>
                </p> -->
                <? if(isset($errors['email'])) :?>
                    <p class="block w-full text-sm text-main-color"><?=$errors['email'] ?></p>
                <? endif; ?>
            </form>
            <? endif; ?>
            <p class="inline-block mt-10 mb-6 text-base font-normal text-main-color">Informații client</p>
            <form id="checkout" class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3" method="post" action="/cart">
                <div class="relative">
                    <input type="text" name="lastname" id="lastname" value="<?= (old('lastname') !== '') ? old('lastname') : ($billing['lastname'] ?? '') ?>" placeholder="Nume" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['lastname']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                    <label for="lastname" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Nume</label>
                </div>
                <div class="relative">
                    <input type="text" name="firstname" id="firstname" value="<?= (old('firstname') !== '') ? old('firstname') : ($billing['firstname'] ?? '') ?>" placeholder="Prenume" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['firstname']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                    <label for="firstname" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Prenume</label>
                </div>
                <div class="relative">
                    <input type="text" name="email" id="email" value="<?= (old('cart_email') !== '') ? old('cart_email') : ($billing['email'] ?? '') ?>" placeholder="Adresa de email" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['cart_email']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                    <label for="email" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Adresa de email</label>
                </div>
                
                <? if(!isset($_SESSION['user']['email'])) : ?>
                <div class="flex flex-wrap items-center justify-start sm:col-span-2 md:col-span-2 lg:col-span-3 gap-x-6">
                    <label for="account-create" class="inline-flex items-center justify-start text-sm font-light cursor-pointer gap-x-2">
                            <input onchange="togglePasswordSection()" type="checkbox" class="accent-main-color" id="account-create" name="account-create" <?= old('account-create') ? 'checked' : '' ?>> Doresc să fac un cont de client
                    </label>
                    <div class="relative <?= old('account-create') ? 'inline-block' : 'hidden' ?> w-full sm:flex-1 mt-6 sm:mt-0" id="passwd">
                        <input type="password" name="password" id="password" value="" placeholder="Alege o parolă" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['password']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                        <label for="password" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Alege o parolă</label>
                    </div>
                    <small id="passwordTip" class="<?= old('account-create') ? 'inline-block' : 'hidden' ?> mt-2 text-xs w-full <?= !isset($errors['password']) ? 'text-slate-500' : 'text-rose-700' ?>">Parola trebuie să conțină minim 8 caractere, măcar o literă mare, un număr și un simbol.</small>
                    <script>
                        function togglePasswordSection() {
                            let accountCreateCheckbox = document.getElementById("account-create");
                            let passwdSection = document.getElementById("passwd");
                            let passwdTip = document.getElementById("passwordTip");

                            if (accountCreateCheckbox.checked) {
                                passwdSection.classList.add("inline-block");
                                passwdSection.classList.remove("hidden");
                                passwdTip.classList.add("inline-block");
                                passwdTip.classList.remove("hidden");
                            } else {
                                passwdSection.classList.remove("inline-block");
                                passwdSection.classList.add("hidden");
                                passwdTip.classList.remove("inline-block");
                                passwdTip.classList.add("hidden");
                            }
                        }
                    </script>
                    
                </div>
                <? endif ?>
                <div>
                    <div class="relative">
                        <input type="text" name="phone" id="phone" value="<?= (old('phone') !== '') ? old('phone') : ($billing['phone'] ?? '') ?>" placeholder="Număr de telefon" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['phone']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                        <label for="phone" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Număr de telefon</label>
                    </div>
                </div>
                <div>
                    <select class="w-full h-full font-light bg-white border-b-2 border-gray-200" name="country">
                        <option>Romania</option>
                    </select>
                </div>
                <div>
                    <select class="w-full h-full font-light bg-white border-b-2 border-gray-200" name="county" required>
                    <?
                        foreach($counties as $county)
                            echo '<option value="'.$county.'" '. ((old('county') == $county || (isset($billing['county']) && $billing['county'] == $county)) ? 'selected' : '') .'>'.$county.'</option>';
                    ?>
                    </select>
                </div>
                <div>
                    <div class="relative">
                        <input type="text" name="city" id="city" value="<?= (old('city') !== '') ? old('city') : ($billing['city'] ?? '') ?>" placeholder="Oras" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['city']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                        <label for="city" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Oras</label>
                    </div>
                </div>
                <div>
                    <div class="relative">
                        <input type="text" name="address" id="address" value="<?= (old('address') !== '') ? old('address') : ($billing['address'] ?? '') ?>" placeholder="Adresa" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['address']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                        <label for="address" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Adresa</label>
                    </div>
                </div>
                <div>
                    <div class="relative">
                        <input type="text" name="zip" id="zip" value="<?= (old('zip') !== '') ? old('zip') : ($billing['zip'] ?? '') ?>" placeholder="Cod postal" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['zip']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                        <label for="zip" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Cod postal</label>
                    </div>
                </div>
                <label for="delivery" class="flex items-center justify-start mt-0 text-sm cursor-pointer sm:col-span-2 md:col-span-2 lg:col-span-3 gap-x-2 hover:text-main-color">
                    <input type="checkbox" name="delivery" id="delivery" onchange="toggleDeliveryInfo()" class=" form-checkbox accent-main-color" <?= old('delivery') ? 'checked' : '' ?>> 
                    <svg xmlns="http://www.w3.org/2000/svg" class="" width="28" height="28" viewBox="0 0 24 24" stroke-width="1" stroke="#ed0078" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                        <path d="M3 9l4 0" />
                    </svg>
                    <span class="ml-0">Doresc livrarea produselor la altă adresă</span>
                </label>

                <div class="grid overflow-hidden duration-500 ease-in <?= old('delivery') ? '' : 'max-h-0' ?> sm:col-span-2 md:col-span-2 lg:col-span-3 gap-x-6 gap-y-10 transition-max-height" id="delivery-info">
                    <p class="-mb-8 text-base font-normal sm:col-span-2 md:col-span-2 lg:col-span-3 text-main-color">Informații livrare</p>
                    <div class="relative">
                        <input type="text" name="delivery_lastname" id="delivery_lastname" value="<?= (old('delivery_lastname') !== '') ? old('delivery_lastname') : ($shipping['lastname'] ?? '') ?>" placeholder="Nume" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['delivery_lastname']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                        <label for="delivery_lastname" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Nume</label>
                    </div>
                    <div class="relative">
                        <input type="text" name="delivery_firstname" id="delivery_firstname" value="<?= (old('delivery_firstname') !== '') ? old('delivery_firstname') : ($shipping['firstname'] ?? '') ?>" placeholder="Prenume" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['delivery_firstname']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                        <label for="delivery_firstname" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Prenume</label>
                    </div>
                    <div>
                        <div class="relative">
                            <input type="text" name="delivery_phone" id="delivery_phone" value="<?= (old('delivery_phone') !== '') ? old('delivery_phone') : ($shipping['phone'] ?? '') ?>" placeholder="Număr de telefon" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['delivery_phone']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                            <label for="delivery_phone" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Număr de telefon</label>
                        </div>
                    </div>
                    <div>
                        <select class="w-full h-full font-light bg-white border-b-2 border-gray-200" name="delivery_country">
                            <option value="Romania">Romania</option>
                        </select>
                    </div>
                    <div>
                        <select class="w-full h-full font-light bg-white border-b-2 border-gray-200" name="delivery_county">
                        <?
                        foreach($counties as $county)
                            echo '<option value="'.$county.'" '. ((old('delivery_county') == $county || (isset($shipping['county']) && $shipping['county'] == $county)) ? 'selected' : '') .'>'.$county.'</option>';
                        ?>
                        </select>
                    </div>
                    <div>
                        <div class="relative">
                            <input type="text" name="delivery_city" id="delivery_city" value="<?= (old('delivery_city') !== '') ? old('delivery_city') : ($shipping['city'] ?? '') ?>" placeholder="Oras" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['delivery_city']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                            <label for="delivery_city" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Oras</label>
                        </div>
                    </div>
                    <div>
                        <div class="relative">
                            <input type="text" name="delivery_address" id="delivery_address" value="<?= (old('delivery_address') !== '') ? old('delivery_address') : ($shipping['address'] ?? '') ?>" placeholder="Adresa" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['delivery_address']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                            <label for="delivery_address" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Adresa</label>
                        </div>
                    </div>
                    <div>
                        <div class="relative">
                            <input type="text" name="delivery_zip" id="delivery_zip" value="<?= (old('delivery_zip') !== '') ? old('delivery_zip') : ($shipping['zip'] ?? '') ?>" placeholder="Cod postal" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['delivery_zip']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                            <label for="delivery_zip" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Cod postal</label>
                        </div>
                    </div>
                </div>
                <script>
                    function toggleDeliveryInfo() {
                        var deliveryCheckbox = document.getElementById("delivery");
                        var deliveryInfo = document.getElementById("delivery-info");

                        if (deliveryCheckbox.checked) {
                            // Checkbox bifat, afișează cu animație
                            deliveryInfo.style.maxHeight = deliveryInfo.scrollHeight + "px";
                        } else {
                            // Checkbox debifat, ascunde cu animație
                            deliveryInfo.style.maxHeight = 0;
                        }
                    }
                </script>
            </form>
        </div>
        

        <div class="p-1 md:p-6 text-sm font-light md:border rounded-md text-slate-700 w-full md:w-[380px] shrink-0">
            <p class="inline-block mb-4 text-base font-normal text-main-color">Sumar comandă: <?= \Core\ShoppingCart::getTotalItemsInCart(); ?> articol(e).</p>
            <p class="flex items-center justify-start py-3 border-b">
                <span class="grow">Subtotal</span>
                <span class="text-right"><?= number_format($Total, 2, ',', '.');?> lei</span>
            </p>
            <p class="flex items-center justify-start py-3 border-b">
                <span class="grow">Transport</span>
                <span class="text-right">16 lei</span>
            </p>
            <p class="flex items-center justify-start py-3 border-b">
                <span class="grow">Total</span>
                <span><?= number_format($Total + 16, 2, ',', '.');?> lei</span>
            </p>

            <p class="inline-block mt-10 text-base font-normal text-main-color">Metodă de plată</p>

            <label for="mobilpay" class="flex items-center justify-start gap-2 mt-4 cursor-pointer">
                <input type="radio" name="payment" id="mobilpay" value="netopia" class="accent-main-color" checked> <span>Card Online prin </span> <img src="/public/images/mobilpay.gif">
            </label>
            
            <label for="terms" class="flex items-start justify-start gap-3 mt-5 cursor-pointer">
                <input type="checkbox" name="terms" id="terms" class="mt-1 accent-main-color">
                <span>Am citit și sunt de acord cu <a href="#" class="text-main-color hover:underline">termenii și condițiile de utilizare</a> a magazinului online.</span>
            </label>

            <label for="privacy" class="flex items-start justify-start gap-3 mt-3 cursor-pointer">
                <input type="checkbox" name="privacy" id="privacy" class="mt-1 accent-main-color">
                <span>Am citit și sunt de acord cu <a href="#" class="text-main-color hover:underline">politica de confidențialitate</a>.</span>
            </label>

            <button id="submitBtn" disabled  form="checkout" class="flex items-center justify-center w-full py-4 mt-6 font-semibold text-white rounded-md disabled:bg-gray-200 disabled:text-stone-600 bg-main-color">
            Acceptă condițiile de mai sus  mai întâi
            </button>
            <script>
                const terms = document.getElementById('terms');
                const privacy = document.getElementById('privacy');
                const submitBtn = document.getElementById('submitBtn');

                terms.addEventListener('change', updateSubmitButtonState);
                privacy.addEventListener('change', updateSubmitButtonState);

                function updateSubmitButtonState() {
                    if (terms.checked && privacy.checked) {
                        submitBtn.removeAttribute('disabled');
                        submitBtn.innerText = 'Înregistrează și plătește comanda';
                    } else {
                        submitBtn.setAttribute('disabled', 'disabled');
                        submitBtn.innerText = 'Acceptă condițiile de mai sus mai întâi';
                    }
                }
            </script>
        </div>
    </section>
</main>
<? require base_path('views/partials/footer.php'); ?>