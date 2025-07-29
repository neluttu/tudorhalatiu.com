<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main class="w-full px-2 max-w-7xl">
    <? Core\Session::getMessage(); ?>
    <section class="flex flex-wrap items-center justify-between px-2 lg:justify-between lg:px-0">
        <form action="/register" method="post" class="w-full md:flex-1 md:w-1/2">
            <div class="relative mt-6">
                <input required type="text" name="email" id="email" value="<?= old('email'); ?>" placeholder="Adresă email" class="w-full px-0 py-2 mt-1 border-b-2 border-gray-200 peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="new-password" />
                <label for="email" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Adresă email</label>
            </div>
            <span class="text-sm text-red-500"><?= $errors['email'] ?? $errors['username_taken'] ?? '' ?> </span>
            <div class="relative mt-6">
                <input required type="password" name="password" id="password" placeholder="Alege o parolă" class="w-full px-0 py-2 mt-1 border-b-2 border-gray-200 peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="new-password"/>
                <label for="password" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Alege o parolă</label>
                <small class="text-xs text-gray-600">Minim <span class="text-main-color" id="check_min_length">8 caractere</span>, unul <span class="text-main-color" id="check_special_char">speci@l</span>, o <span class="text-main-color" id="check_uppercase">Litera mare</span> și <span class="text-main-color" id="check_number">1 număr</span>.</small>
                <script src="/public/js/passwordInputValidate.js"></script>
            </div>
            <span class="text-sm text-red-500"><?= $errors['password'] ?? '' ?></span>
            <div class="relative mt-6">
                <input required type="text" name="firstname" value="<?= old('firstname'); ?>" id="firstname" placeholder="Prenume" class="w-full px-0 py-2 mt-1 border-b-2 border-gray-200 peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" />
                <label for="firstname" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Prenume</label>
            </div>
            <span class="text-sm text-red-500"><?= $errors['firstname'] ?? '' ?></span>
            <div class="relative mt-6">
                <input required type="text" name="lastname" value="<?= old('lastname'); ?>" id="lastname" placeholder="Nume" class="w-full px-0 py-2 mt-1 border-b-2 border-gray-200 peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" />
                <label for="lastname" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Nume</label>
            </div>
            <span class="text-sm text-red-500"><?= $errors['lastname'] ?? '' ?></span>
            <div class="relative mt-6">
                <input required type="text" pattern="[0-9]{10}" title="Introduceți un număr de telefon valid (10 cifre)." name="phone" value="<?= old('phone'); ?>" id="phone" placeholder="Număr telefon" class="w-full px-0 py-2 mt-1 border-b-2 border-gray-200 peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" />
                <label for="phone" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Număr telefon</label>
            </div>
            <span class="text-sm text-red-500"><?= $errors['phone'] ?? '' ?></span>
            <input type="text" name="Telephone" class="hidden" value="<?= old('Telephone'); ?>">
            <button type="submit" class="w-full px-3 py-4 my-4 mt-10 text-white bg-black rounded-md focus:bg-gray-600 focus:outline-none">Înregistrează contul</button>
        
            <p class="text-sm text-center text-gray-500">
                Aveți cont deja?
                <a href="/login"
                    class="font-semibold text-gray-600 hover:underline focus:text-gray-800 focus:outline-none">Autentifică-te</a> sau <a href="/reset-password" class="font-semibold text-gray-600 hover:underline focus:text-gray-800 focus:outline-none">resetează parola.</a>
            </p>
        </form>
        <img src="/public/images/register.webp" class="self-start w-full mt-10 md:mt-0 md:flex-1 md:w-1/2" alt="Cont client tudorhalatiu.com" loading="lazy" />
    </section>
</main>

<? require base_path('views/partials/footer.php'); ?>