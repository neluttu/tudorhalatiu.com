<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="flex flex-col items-start justify-start w-full gap-6 px-2 mt-2 md:mt-10 md:flex-row max-w-7xl">
    <div class="flex shrink-0 flex-row md:flex-col flex-wrap items-start md:justify-center w-full md:w-64 gap-3 text-slate-600  [&>a]:border-b [&>a]:border-transparent  [&>a:hover]:text-main-color [&>a:hover]:border-b [&>a:hover]:border-main-color">
        <? require base_path('views/account/menu.view.php') ?>
    </div>
    <div class="w-full md:grow">
        <div class="p-2 py-3 mb-5 border rounded-md empty:hidden font-lighter border-rose-400 bg-rose-50"><? if(isset($errors)) : foreach ($errors as $error) : ?>
            <p class="text-sm text-main-color"><?= $error; ?></p>
        <? endforeach; endif ?></div>
            <p class="mb-4 text-xl font-semibold text-main-color">Adresa implicită de facturare </p>
            <form id="checkout" class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3" method="post" action="/account/addresses">
                <input type="hidden" name="_method" value="PATCH" />
                <div class="relative">
                    <input required type="text" name="lastname" id="lastname" value="<?= $billing['lastname'] ?>" placeholder="Nume" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['lastname']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                    <label for="lastname" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Nume</label>
                </div>
                <div class="relative">
                    <input required type="text" name="firstname" id="firstname" value="<?= $billing['firstname'] ?>" placeholder="Prenume" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['firstname']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                    <label for="firstname" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Prenume</label>
                </div>
                <div class="relative">
                    <input required type="text" name="email" id="email" value="<?= $billing['email'] ?>" placeholder="Adresa de email" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['email']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                    <label for="email" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Adresa de email</label>
                </div>
                <div>
                    <div class="relative">
                        <input required type="text" name="phone" id="phone" value="<?= $billing['phone'] ?>" placeholder="Număr de telefon" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['phone']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                        <label for="phone" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Număr de telefon</label>
                    </div>
                </div>
                <div>
                    <select class="w-full h-full font-light bg-white border-b-2 border-gray-200" name="country" required>
                        <option>Romania</option>
                    </select>
                </div>
                <div>
                    <select class="w-full h-full font-light bg-white border-b-2 border-gray-200" name="county" required>
                    <?
                        foreach($counties as $county)
                            echo '<option value="'.$county.'" '. (($billing['county'] == $county) ? 'selected' : '') .'>'.$county.'</option>';
                    ?>
                    </select>
                </div>
                <div>
                    <div class="relative">
                        <input required type="text" name="city" id="city" value="<?= $billing['city'] ?>" placeholder="Oras" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['city']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                        <label for="city" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Oras</label>
                    </div>
                </div>
                <div>
                    <div class="relative">
                        <input required type="text" name="address" id="address" value="<?= $billing['address'] ?>" placeholder="Adresa" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['address']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                        <label for="address" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Adresa</label>
                    </div>
                </div>
                <div>
                    <div class="relative">
                        <input required type="text" name="zip" id="zip" value="<?= $billing['zip']  ?>" placeholder="Cod postal" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['zip']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                        <label for="zip" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Cod postal</label>
                    </div>
                </div>
                <p class="col-span-3 mt-10 -mb-5 text-xl font-semibold text-main-color">Adresa implicită de livrare</p>
                <div class="relative">
                    <input type="text" name="delivery_lastname" id="delivery_lastname" value="<?= $shipping['lastname'] ?>" placeholder="Nume" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['delivery_lastname']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                    <label for="delivery_lastname" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Nume</label>
                </div>
                <div class="relative">
                    <input type="text" name="delivery_firstname" id="delivery_firstname" value="<?= $shipping['firstname'] ?>" placeholder="Prenume" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['delivery_firstname']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                    <label for="delivery_firstname" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Prenume</label>
                </div>
                <div>
                    <div class="relative">
                        <input type="text" name="delivery_phone" id="delivery_phone" value="<?= $shipping['phone'] ?>" placeholder="Număr de telefon" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['delivery_phone']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
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
                        echo '<option value="'.$county.'" '. ((isset($shipping['county']) && $shipping['county'] == $county) ? 'selected' : '') .'>'.$county.'</option>';
                    ?>
                    </select>
                </div>
                <div>
                    <div class="relative">
                        <input type="text" name="delivery_city" id="delivery_city" value="<?= $shipping['city'] ?>" placeholder="Oras" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['delivery_city']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                        <label for="delivery_city" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Oras</label>
                    </div>
                </div>
                <div>
                    <div class="relative">
                        <input type="text" name="delivery_address" id="delivery_address" value="<?= $shipping['address'] ?>" placeholder="Adresa" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['delivery_address']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                        <label for="delivery_address" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Adresa</label>
                    </div>
                </div>
                <div>
                    <div class="relative">
                        <input type="text" name="delivery_zip" id="delivery_zip" value="<?= $shipping['zip'] ?>" placeholder="Cod postal" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['delivery_zip']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                        <label for="delivery_zip" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Cod postal</label>
                    </div>
                </div>
                <div class="col-span-3 text-right">
                    <button class="col-span-3 px-4 py-1 text-white rounded-md md:py-2 bg-main-color grow">Actualizează datele</button>
                </div>
            </form>
    </div>
</main>

<? require base_path('views/partials/footer.php'); ?>