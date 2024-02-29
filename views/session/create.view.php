<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="w-full px-2 max-w-7xl">
    <? if(!empty($message)) : ?>
        <div class="w-full px-2 py-3 mb-4 bg-white border rounded-md text-rose-600 border-slate-300">
        <?= $message['success'] ?? '' ?>
        </div>
    <? endif ?>
    <section class="flex flex-wrap items-center justify-center px-2 lg:justify-between lg:px-0">
        <form action="<?= \Core\Session::getLang(); ?>/session" method="post" class="self-start order-2 w-full md:flex-1 md:w-1/2 md:order-1">
            <div class="relative mt-6">
                <input type="text" required name="email" id="email" value="<?= old('email') ?? '' ?>" placeholder="Adresa de email" class="<?= isset($errors['email']) ? 'shake-horizontal' : '' ?> w-full px-0 py-2 mt-1 border-b-2 border-gray-200 peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" autocomplete="NA" />
                <label for="email" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Adresa de email</label>
            </div>

            <div class="relative mt-6">
                <input type="password" required name="password" id="password" placeholder="Parola contului" class="<?= old('password') ? 'shake-horizontal' : '' ?> w-full px-0 py-2 mt-1 border-b-2 border-gray-200 peer placeholder:text-transparent focus:border-gray-500 focus:outline-none" />
                <label for="password" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Parola contului</label>
            </div>

            <span class="text-sm text-red-500"><?= $errors['email'] ?? '' ?></span>

            <button type="submit" class="w-full px-3 py-4 my-4 text-white bg-black rounded-md focus:bg-gray-600 focus:outline-none">Accesează contul de client</button>

            <p class="mt-2 text-sm text-gray-500">
                <a href="<?= \Core\Session::getLang(); ?>/register" class="font-semibold text-gray-600 hover:underline focus:text-gray-800 focus:outline-none">Deschid cont nou</a> sau <a href="<?= \Core\Session::getLang(); ?>/reset-password" class="font-semibold text-gray-600 hover:underline focus:text-gray-800 focus:outline-none">resetez parola contului.</a>
            </p>
        </form>
        <img src="/public/images/dress-model.jpg" class="self-start order-1 w-full mt-10 md:mt-0 md:flex-1 md:w-1/2 md:order-2" alt="Autentificare cont client tudorhalatiu.com" />
    </section>
</main>

<? require base_path('views/partials/footer.php'); ?>