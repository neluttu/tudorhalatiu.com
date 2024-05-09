<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="w-full px-2 max-w-7xl">
    <? if(!empty($errors)) : ?>
        <div class="p-3 mb-4 text-sm border rounded-md empty:hidden border-rose-400 bg-rose-100 text-rose-600"><?= $errors['invalid_email'] ?? $errors['null_user'] ?? $errors['reset_active'] ?? '' ?></div>
    <? endif ?>
    <!-- <p><?=$result['token'] ?? '' ?></p> -->
    <section class="flex flex-wrap items-center justify-center px-2 lg:justify-between lg:px-0">
        <form method="POST" class="self-start order-2 w-full md:flex-1 md:w-1/2 md:order-1">
            <div class="relative mt-6">
            <input type="text" required name="email" id="email" value="<?= old('email') ?? '' ?>" placeholder="Adresa de email" class="w-full px-0 py-2 mt-1 border-b-2 <?= isset($errors['email']) ? 'border-main-color shake-horizontal' : 'border-gray-200' ?> peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                    <label for="email" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Adresa de email</label>
            </div>
            <div class="my-6">
                <button type="submit" class="w-full px-3 py-4 text-white bg-black rounded-md focus:bg-gray-600 focus:outline-none">Cere resetarea parolei</button>
            </div>
            <p class="text-sm text-center text-gray-500">Nu sunteți înregistrat? 
                <a href="/register"
                    class="font-semibold text-gray-600 hover:underline focus:text-gray-800 focus:outline-none">Creați un cont acum</a>.
            </p>
        </form>
        <img src="/public/images/dress-model.jpg" class="self-start order-1 w-full mt-10 md:mt-0 md:flex-1 md:w-1/2 md:order-2" alt="Autentificare cont client tudorhalatiu.com" loading="lazy" />
    </section>
</main>

<?php require base_path('views/partials/footer.php'); ?>