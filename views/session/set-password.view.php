<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="w-full px-2 max-w-7xl">
    <section class="flex flex-wrap items-center justify-center px-2 lg:justify-between lg:px-0">
        <form method="POST" class="self-start order-2 w-full md:flex-1 md:w-1/2 md:order-1">
            <input type="hidden" name="token" value="<?= $params ?>" />
            <div class="relative mt-6">
                <input type="password" name="password" id="password" placeholder="Introdu parola nouă aici" class="w-full px-0 py-1 mt-1 border-b-2 <?= isset($errors['password']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                <label for="password" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform opacity-75 pointer-events-none -translate-y-2/3 peer-placeholder-shown:top-1/3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Introdu parola nouă aici</label>
                <small class="text-xs text-gray-600">Minim <span class="text-main-color" id="check_min_length">8 caractere</span>, unul <span class="text-main-color" id="check_special_char">speci@l</span>, o <span class="text-main-color" id="check_uppercase">Litera mare</span> și <span class="text-main-color" id="check_number">1 număr</span>.</small>
            </div>
            <div class="relative mt-6">
                <input type="password" name="password_verify" id="password_verify" placeholder="Confirmă parola nouă" class="w-full px-0 py-1 mt-1 border-b-2 <?= isset($errors['password_verify']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:outline-none" autocomplete="NA" />
                <label for="password_verify" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Confirmă parola nouă</label>
            </div>
            <?= $errors['empty'] ?? $errors['password_verify'] ?? '' ?>
            <div class="mt-6 mb-3">
                <button type="submit" id="submitButton" name="reset_password" class="w-full px-3 py-4 text-white bg-black rounded-md focus:bg-gray-600 focus:outline-none">Setază parola nouă</button>
            </div>
            <p class="text-sm text-left text-gray-500"> <a href="/register" title="Înregistrare cont client" class="font-semibold text-gray-600 hover:underline focus:text-gray-800 focus:outline-none">Creați un cont acum</a> sau  <a href="/login" class="font-semibold text-gray-600 hover:underline focus:text-gray-800 focus:outline-none" title="Autentificare cont">autentificați-vă</a>
            </p>
        </form>        

        <script src="/public/js/passwordInputValidate.js"></script>

        <img src="/public/images/dress-model.jpg" class="self-start order-1 hidden w-full mt-10 md:block md:mt-0 md:flex-1 md:w-1/2 md:order-2" alt="Autentificare cont client tudorhalatiu.com" loading="lazy" />
    </section>
</main>


<? require base_path('views/partials/footer.php'); ?>