<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>
<main class="w-full px-2 max-w-7xl">
    <? if(!empty($message)) : ?>
        <div class="p-3 mb-4 text-sm border rounded-md border-rose-400 bg-rose-100 text-rose-600">
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
                <svg xmlns="http://www.w3.org/2000/svg" id="showPassword" class="absolute transition-opacity duration-300 ease-in-out opacity-100 cursor-pointer right-1 top-2 text-main-color" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z"></path>
                </svg>
                
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute hidden transition-opacity duration-300 ease-in-out opacity-0 cursor-pointer right-1 top-2 text-main-color" id="hidePassword" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M53.92,34.62A8,8,0,1,0,42.08,45.38L61.32,66.55C25,88.84,9.38,123.2,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208a127.11,127.11,0,0,0,52.07-10.83l22,24.21a8,8,0,1,0,11.84-10.76Zm47.33,75.84,41.67,45.85a32,32,0,0,1-41.67-45.85ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.16,133.16,0,0,1,25,128c4.69-8.79,19.66-33.39,47.35-49.38l18,19.75a48,48,0,0,0,63.66,70l14.73,16.2A112,112,0,0,1,128,192Zm6-95.43a8,8,0,0,1,3-15.72,48.16,48.16,0,0,1,38.77,42.64,8,8,0,0,1-7.22,8.71,6.39,6.39,0,0,1-.75,0,8,8,0,0,1-8-7.26A32.09,32.09,0,0,0,134,96.57Zm113.28,34.69c-.42.94-10.55,23.37-33.36,43.8a8,8,0,1,1-10.67-11.92A132.77,132.77,0,0,0,231.05,128a133.15,133.15,0,0,0-23.12-30.77C185.67,75.19,158.78,64,128,64a118.37,118.37,0,0,0-19.36,1.57A8,8,0,1,1,106,49.79,134,134,0,0,1,128,48c34.88,0,66.57,13.26,91.66,38.35,18.83,18.83,27.3,37.62,27.65,38.41A8,8,0,0,1,247.31,131.26Z"></path>
                </svg>
                <input type="password" required name="password" id="password" placeholder="Parola contului" class="w-full px-0 py-2 mt-1 placeholder-transparent border-b-2 border-gray-200 focus:border-gray-500 focus:outline-none" />
                <label for="password" class="absolute top-0 left-0 text-sm text-gray-800 transition-all duration-100 ease-in-out origin-left transform -translate-y-1/2 opacity-75 pointer-events-none peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:pl-0 peer-focus:text-sm peer-focus:text-gray-800">Parola contului</label>
            </div>
            <script src="/public/js/togglePassword.js"></script>

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